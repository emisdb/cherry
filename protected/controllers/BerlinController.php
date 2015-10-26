<?php
class BerlinController extends Controller
{
    public function accessRules()
	{
		return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','book','thankyou'),
	       		'users'=>array('*'),  
            ),
		    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
                'roles'=>array('guide'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
                'roles'=>array('office'),                
			),
           	array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
                'roles'=>array('admin'),                
			),            
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
                'roles'=>array('root'),                
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
  /*  public function actionThankyou()
	{
	    $this->layout = "berlin";
        
        
    }    */  


    public function actionBook($id, $cat)
	{
	    $this->layout = "berlin";
            
        $scheduled = SegScheduledTours::model()->findByPk($id);
        
		/*tourroutes*/
        if($scheduled->tourroute_id==null){
            $criteria_tours_link = new CDbCriteria;
            $criteria_tours_link->condition = 'usersid=:usersid';
            $criteria_tours_link->params = array(':usersid' => $scheduled->guide1_id);
            $criteria_tours_link->join = 'LEFT JOIN `seg_guides_tourroutes` ON ((`seg_guides_tourroutes`.`tourroutes_id` = `t`.`id_tour_categories`) AND(`t`.`cityid` = '.$scheduled->city_id.'))';
            $tours_guide = SegTourroutes::model()->findAll($criteria_tours_link);
        }else{
			$criteria_tours_link2 = new CDbCriteria;
            $criteria_tours_link2->condition = 'idseg_tourroutes=:idseg_tourroutes';
            $criteria_tours_link2->params = array(':idseg_tourroutes' => $scheduled->tourroute_id);
            $tours_guide = SegTourroutes::model()->findAll($criteria_tours_link2);
        }
         
		 /*languages*/
        if($scheduled->language_id==null){
            $criteria_lan_link = new CDbCriteria;
            $criteria_lan_link->condition = 'users_id=:users_id';
            $criteria_lan_link->params = array(':users_id' => $scheduled->guide1_id);
            $criteria_lan_link->join = 'LEFT JOIN `seg_languages_guides` ON `seg_languages_guides`.`languages_id` = `t`.`id_languages`';
            $languages_guide = Languages::model()->findAll($criteria_lan_link);
        }else{
            $languages_guide = Languages::model()->findByPk($scheduled->language_id);
        } 
         
        /*  
        $criteria = new CDbCriteria;
        $criteria->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
        $criteria->params = array(':cityid' => $scheduled->city_id,':id_tour_categories'=>$cat);
        $languages_guide = SegTourroutes::model()->find($criteria);
		*/
		
		/*tourroute for cat*/
        $criteria = new CDbCriteria;
        $criteria->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
        $criteria->params = array(':cityid' => $scheduled->city_id,':id_tour_categories'=>$cat);
        $tour = SegTourroutes::model()->find($criteria);
        
        //$model = new SegContacts;
        
        $contact = new Book;
        
       	if(isset($_POST['Book']))
		{
			$scheduled->tourroute_id = $_POST['Book']['tour'];
			$scheduled->language_id = $_POST['Book']['language'];
			
			$contact->attributes=$_POST['Book'];
			
			$ticket_array = SegTourroutes::model()->findByPk($_POST['Book']['tour']);
			
			$cat_i = $_POST['Book']['cat_hidden'];
			if($cat_i == 1)$ticket_count = $_POST['Book']['tickets1'];
			if($cat_i == 2)$ticket_count = $_POST['Book']['tickets2'];
			if($cat_i == 3)$ticket_count = $_POST['Book']['tickets3'];
			$contact->tickets = $ticket_count; 
			/*if (isset($_POST['Book']['tickets'])){
				print_r('yes tiket');
			}else{
				print_r('no tiket'  );
			}*/
			
			//print_r($_POST['Book']['cat_hidden'].'88');

            if($contact->validate()){
								
				//save contact
				$user_contact =  new SegContacts;
				
				$user_contact->firstname = $_POST['Book']['firstname'];
				$user_contact->surname = $_POST['Book']['lastname'];
				$user_contact->additional_address = $_POST['Book']['address'];
				$user_contact->city = $_POST['Book']['city'];
				$user_contact->country = $_POST['Book']['country'];
				$user_contact->phone = $_POST['Book']['phone'];
				$user_contact->email = $_POST['Book']['email'];
				$user_contact->save();
				
				//save booking
				$id_user = $user_contact->idcontacts;
				$current = new SegBookings;
				$current->customer_id = $id_user;
				$current->groupsize = $ticket_count;
				$current->sched_tourid = $id;
				$current->save();

				$id_book = $current->idseg_bookings;
				
				
				//save guidestourinvoice
				$guidestourinvoices = new SegGuidestourinvoices;
		
			
				$guidestourinvoices->creationDate = $scheduled->date;
				$guidestourinvoices->cityid = $scheduled->city_id;
				$guidestourinvoices->sched_tourid = $scheduled->tourroute_id;
				$guidestourinvoices->guideNr = $scheduled->guide1_id;
				$guidestourinvoices->status = 0;
				$guidestourinvoices->id_sched = $scheduled->idseg_scheduled_tours;
				$guidestourinvoices->save();	
				
			
				
				//save guidestourinvoicecustomers
				$id_invoice = $guidestourinvoices->idseg_guidesTourInvoices;
				for($j=0;$j<$ticket_count;$j++){
					$guidestourinvoicescustomers = new SegGuidestourinvoicescustomers;
					$guidestourinvoicescustomers->customersName = $user_contact->firstname.' '.$user_contact->surname;
					$guidestourinvoicescustomers->price = $tour->base_price;
					$guidestourinvoicescustomers->cityid = $tour->cityid;
					
					$guidestourinvoicescustomers->tourInvoiceid = $id_invoice;
					
					//$guidestourinvoicescustomers->CustomeInvoicNumber = ;
					$b = $tour->city['seg_cityname']{0};
					$year = date('y',time());
					$max= Yii::app()->db->createCommand("SELECT max(CustomerInvoiceNumber) from seg_guidestourinvoicescustomers where cityid=".$tour->cityid)->queryScalar();
					$max_i = $max+1;
					
					$guidestourinvoicescustomers->KA_string = 'KA'.$b.$year.'/'.$max_i;
					$guidestourinvoicescustomers->CustomerInvoiceNumber = $max_i;
					$guidestourinvoicescustomers->isPaid = 0;
					$guidestourinvoicescustomers->origin_booking = $id_book;
					
					
					$guidestourinvoicescustomers->save();
				}
				
            	//save scheduled
				$scheduled->TNmax_sched = $ticket_array->TNmax;
				if($scheduled->current_subscribers==null){
					$scheduled->current_subscribers=$ticket_count;
				}else{
					$scheduled->current_subscribers=$scheduled->current_subscribers +$ticket_count;
				}
				$scheduled->save();
				
            	//email
				$date_ex = date('d/m/Y',$_POST['Book']['date_ex']);
					
				//print_r('time - '.$_POST['Book']['time_ex']);
				//print_r('<br>');
				$x1 = strtotime($_POST['Book']['time_ex']) - strtotime("00:00:00");
				//print_r('strtotime - '.$x1);
				//print_r('<br>');
				$x2 = $tour->standard_duration*60;
				//print_r('duration - '.$x2);
				//print_r('<br>');
				$x3 = $x1+$x2;
				//print_r('vse - '.$x3);
				//print_r('<br>');
				$x4 = $x3+strtotime("00:00:00");
				//print_r('nowtime - '.$x4);
				//print_r('<br>');
				$x5 = date('H:i:s',$x4);
				//print_r('date - '.$x5);
				//print_r('<br>');
				$tourend = $x5;
				
				$guidename = $scheduled->user_ob->contact_ob->firstname;
				$guidemnr = $scheduled->user_ob->contact_ob->phone;
				
				$message="Thank you for booking your city tour with Cherry Tours ".$scheduled->city_ob->seg_cityname;
				$message.="\n";
				$message.="\nWe have just reserved the following tour date for you:";
				$message.="\n".$date_ex;
				$message.="\nTour start: ".$_POST['Book']['time_ex']." (Please show up at the assigned meeting point about 10 minutes before tour start.)";
				$message.="\n";
				$message.="\nEnd of tour: ".$tourend;
				$message.="\nTour route: ".$scheduled->tourroute_ob->name;
				$message.="\nTour language: ".$scheduled->language_ob->englishname;
				$message.="\nTour guide: ".$guidename;
				$message.="\nGuide phone: ".$guidemnr."(for last-minute requests regarding weather or meeting point)";
				
				$message.="\nFurthermore we recommend:";
				$message.="\n- comfortable shoes, no high heels";
				$message.="\n- adequate clothing (below 15 degrees centigrade, we especially recommend wearing warm clothes and gloves)";
				$message.="\n- sunglasses, if necessary sun protection etc.";
				$message.="\n";
				$message.="\nPayment:";
				$message.="\n- On site";
				$message.="\n";
				$message.="\nWe accept the following methods of payment:";
				$message.="\n- Cash in EUR";
				$message.="\n- EC";
				$message.="\n- Credit cards (Visa, Master Card, American Express, JCB Cards, Union Pay)";
				$message.="\n- Vouchers purchased at Cherry Tours";
				$message.="\n";
				
				$message.="\nWeather:";
				$message.="\nIf the weather forecast shows a high chance of rain at the tour date, we will contact you near-term via email, SMS or phone and inform you if the tour has to be cancelled.";
				$message.="\nIf it rains despite a positive weather forecast, the tour guide will decide on-site if the tour can take place. Generally, the tour is arranged along a route where you can always take cover in case of a short rain shower."; 
				$message.="\n";
				$message.="\n";
				
				$name_forms = $scheduled->city_ob->seg_cityname;
				$to = $user_contact->email;
				if ($this->sendMail($to, $name_forms, $message))
				{
				
				    $stuttgart_link = Yii::app()->createUrl('thankyou');
				    header( 'Location: '.$stuttgart_link.'?id=1' );
				}
			}
		}
		
		$criteria_cat = new CDbCriteria;
        $criteria_cat->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
        $criteria_cat->params = array(':cityid' => $scheduled->city_id,':id_tour_categories'=>$cat);
		$cat_item = SegTourroutes::model()->find($criteria_cat)->idseg_tourroutes;

        $this->render('book',array('scheduled'=>$scheduled,'contact'=>$contact,'tour'=>$tour,'tours_guide'=>$tours_guide,'languages_guide'=>$languages_guide,'cat_item'=>$cat_item));
       
    } 
	protected function sendMail($to,$subject,$body)
	{
		        Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
                $message->setBody($body);
                $message->subject = $subject;
                $message->addTo($to);
//                $message->addTo(Yii::app()->params['adminEmail']);
                $message->from = Yii::app()->params['adminEmail'];
//                $pathto=Yii::app()->params['load_xml_pdf'].$filename;
//                $swiftAttachment = Swift_Attachment::fromPath($pathto); 
//               $message->attach($swiftAttachment);
               return Yii::app()->mail->send($message);
		}
    
	public function actionIndex($city=null, $date=null, $time=null, $language=null, $guide=null)
	{
		$this->processPageRequest('page');
		  
	    $this->layout = "berlin";

		if($city==null){
			$cookie_city=Yii::app()->request->cookies['city_berlin']; 
			$city=$cookie_city->value;
		}
		if(($city=='')or(isset($city)))$city=1;
		
		//$cookie_city=Yii::app()->request->cookies['city_berlin']; //???? cookie city
		//$city_c=$cookie_city->value;
		
		if($date==null){
			$cookie_date=Yii::app()->request->cookies['date_berlin'];
			$date=$cookie_date->value;
		}
		if(($date=='Date')or($date=='')or(!isset($date)))$date =date('d.m.Y');
		//$cookie_date=Yii::app()->request->cookies['date_berlin'];
		//$date_c=$cookie_date->value;
		
		if($time==null){
			$time_bd = date('H:i:s'); // now time in hosting
		}else{
			$criteria_time = new CDbCriteria;
			$criteria_time->condition = 'idseg_starttimes=:idseg_starttimes';
			$criteria_time->params = array(':idseg_starttimes' => $time);
			$time_bd = SegStarttimes::model()->find($criteria_time)->timevalue;		
		}

		$date_format = strtotime($date);
		$town = SegCities::model()->findByPk($city);
        $date_bd = date('Y-m-d',$date_format);
		$dt =$date_bd.' '.$time_bd;

		//classic
		$criteria_classic = new CDbCriteria;
		$criteria_classic->alias = 's';
		
		//0
		if(($language==null)and($guide==null)){
			$criteria_classic->join = 'LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id';
			$criteria_classic->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt)';
			$criteria_classic->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>1, ':tourroutes_id' => 1,':dt' => $dt);
		}
		
		//0 g
		if(($language==null)and($guide!=null)){
			$criteria_classic->join = 'LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id';
			$criteria_classic->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND guide1_id=:guide1_id';
			$criteria_classic->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>1, ':tourroutes_id' => 1,':dt' => $dt, ':guide1_id'=>$guide);
		}

		//0 l
		if(($language!=null)and($guide==null)){
			$criteria_classic->join = '
			LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes 
			LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id 
			LEFT JOIN tbl_languages as l ON s.language_id=l.id_languages 
			LEFT JOIN seg_languages_guides as lg ON lg.users_id = s.guide1_id';
			$criteria_classic->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND (s.language_id IS NOT NULL AND l.id_languages = :id_languages OR s.language_id IS NULL AND lg.languages_id = :languages_id)';
			$criteria_classic->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>1, ':tourroutes_id' => 1,':dt' => $dt, ':id_languages'=>$language,':languages_id' => $language);
		}
		
		//0 g l
		if(($language!=null)and($guide!=null)){
			$criteria_classic->join = '
			LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes 
			LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id 
			LEFT JOIN tbl_languages as l ON s.language_id=l.id_languages 
			LEFT JOIN seg_languages_guides as lg ON lg.users_id = s.guide1_id';
			$criteria_classic->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND (s.language_id IS NOT NULL AND l.id_languages = :id_languages OR s.language_id IS NULL AND lg.languages_id = :languages_id) AND guide1_id=:guide1_id';
			$criteria_classic->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>1, ':tourroutes_id' => 1,':dt' => $dt, ':id_languages'=>$language,':languages_id' => $language,':guide1_id'=>$guide);
		}
				
		$criteria_classic->group = 's.idseg_scheduled_tours';
		$criteria_classic->order = 'date ASC, starttime ASC';

		$count_classic = SegScheduledTours::model()->count($criteria_classic);
		$pages_classic = new CPagination($count_classic);
		$pages_classic->pageSize = 5;
		$pages_classic->applyLimit($criteria_classic);
		  
		$scheduleds_classic = SegScheduledTours::model()->findAll($criteria_classic);
		
		foreach($scheduleds_classic as $item){ 
			$criteria_tour_tmax1 = new CDbCriteria;
			$criteria_tour_tmax1->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
			$criteria_tour_tmax1->params = array(':cityid' => $town->idseg_cities, ':id_tour_categories' => 1);
			$item->tour_i = SegTourroutes::model()->find($criteria_tour_tmax1)->TNmax;	
		}
		
		//historical
		$criteria_historical = new CDbCriteria;
		$criteria_historical->alias = 's';
		
		//0
		if(($language==null)and($guide==null)){
			$criteria_historical->join = 'LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id';
			$criteria_historical->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt)';
			$criteria_historical->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>2, ':tourroutes_id' => 2,':dt' => $dt);
		}
		
		//0 g
		if(($language==null)and($guide!=null)){
			$criteria_historical->join = 'LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id';
			$criteria_historical->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND guide1_id=:guide1_id';
			$criteria_historical->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>2, ':tourroutes_id' => 2,':dt' => $dt, ':guide1_id'=>$guide);
		}

		//0 l
		if(($language!=null)and($guide==null)){
			$criteria_historical->join = '
			LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes 
			LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id 
			LEFT JOIN tbl_languages as l ON s.language_id=l.id_languages 
			LEFT JOIN seg_languages_guides as lg ON lg.users_id = s.guide1_id';
			$criteria_historical->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND (s.language_id IS NOT NULL AND l.id_languages = :id_languages OR s.language_id IS NULL AND lg.languages_id = :languages_id)';
			$criteria_historical->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>2, ':tourroutes_id' => 2,':dt' => $dt, ':id_languages'=>$language,':languages_id' => $language);
		}
		
		//0 g l
		if(($language!=null)and($guide!=null)){
			$criteria_historical->join = '
			LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes 
			LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id 
			LEFT JOIN tbl_languages as l ON s.language_id=l.id_languages 
			LEFT JOIN seg_languages_guides as lg ON lg.users_id = s.guide1_id';
			$criteria_historical->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND (s.language_id IS NOT NULL AND l.id_languages = :id_languages OR s.language_id IS NULL AND lg.languages_id = :languages_id) AND guide1_id=:guide1_id';
			$criteria_historical->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>2, ':tourroutes_id' => 2,':dt' => $dt, ':id_languages'=>$language,':languages_id' => $language,':guide1_id'=>$guide);
		}
		
		$criteria_historical->group = 's.idseg_scheduled_tours';
		$criteria_historical->order = 'date ASC, starttime ASC';
		
		$count_historical = SegScheduledTours::model()->count($criteria_historical);
		$pages_historical = new CPagination($count_historical);
		$pages_historical->pageSize = 5;
		$pages_historical->applyLimit($criteria_historical);
		  
		$scheduleds_historical = SegScheduledTours::model()->findAll($criteria_historical);
		
		foreach($scheduleds_historical as $item){ 
			$criteria_tour_tmax2 = new CDbCriteria;
			$criteria_tour_tmax2->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
			$criteria_tour_tmax2->params = array(':cityid' => $town->idseg_cities, ':id_tour_categories' => 2);
			$item->tour_i = SegTourroutes::model()->find($criteria_tour_tmax2)->TNmax;	
		}

		//special	
		$criteria_special = new CDbCriteria;
		$criteria_special->alias = 's';
				
		//0
		if(($language==null)and($guide==null)){
			$criteria_special->join = 'LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id';
			$criteria_special->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt)';
			$criteria_special->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>3, ':tourroutes_id' => 3,':dt' => $dt);
		}
		
		//0 g
		if(($language==null)and($guide!=null)){
			$criteria_special->join = 'LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id';
			$criteria_special->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND guide1_id=:guide1_id';
			$criteria_special->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>3, ':tourroutes_id' => 3,':dt' => $dt, ':guide1_id'=>$guide);
		}

		//0 l
		if(($language!=null)and($guide==null)){
			$criteria_special->join = '
			LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes 
			LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id 
			LEFT JOIN tbl_languages as l ON s.language_id=l.id_languages 
			LEFT JOIN seg_languages_guides as lg ON lg.users_id = s.guide1_id';
			$criteria_special->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND (s.language_id IS NOT NULL AND l.id_languages = :id_languages OR s.language_id IS NULL AND lg.languages_id = :languages_id)';
			$criteria_special->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>3, ':tourroutes_id' => 3,':dt' => $dt, ':id_languages'=>$language,':languages_id' => $language);
		}
		
		//0 g l
		if(($language!=null)and($guide!=null)){
			$criteria_special->join = '
			LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes 
			LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id 
			LEFT JOIN tbl_languages as l ON s.language_id=l.id_languages 
			LEFT JOIN seg_languages_guides as lg ON lg.users_id = s.guide1_id';
			$criteria_special->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt) AND (s.language_id IS NOT NULL AND l.id_languages = :id_languages OR s.language_id IS NULL AND lg.languages_id = :languages_id) AND guide1_id=:guide1_id';
			$criteria_special->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>3, ':tourroutes_id' => 3,':dt' => $dt, ':id_languages'=>$language,':languages_id' => $language,':guide1_id'=>$guide);
		}
		
		//$criteria_special->join = 'LEFT JOIN seg_tourroutes as t ON s.tourroute_id=t.idseg_tourroutes LEFT JOIN seg_guides_tourroutes as g ON g.usersid = s.guide1_id';
		
		
		
		//$criteria_special->condition = 'city_id=:city_id AND (s.tourroute_id IS NOT NULL AND t.id_tour_categories = :id_tour_categories OR s.tourroute_id IS NULL AND g.tourroutes_id = :tourroutes_id) AND (Concat(date," ",starttime)>= :dt)';
		//$criteria_special->params = array(':city_id' => $town->idseg_cities,':id_tour_categories' =>3, ':tourroutes_id' => 3,':dt' => $dt);
		
		$criteria_special->group = 's.idseg_scheduled_tours';
		$criteria_special->order = 'date ASC, starttime ASC';
		  
		$count_special = SegScheduledTours::model()->count($criteria_special);
		$pages_special = new CPagination($count_special);
		$pages_special->pageSize = 5;
		$pages_special->applyLimit($criteria_special);

		$scheduleds_special = SegScheduledTours::model()->findAll($criteria_special);			
		
		foreach($scheduleds_special as $item){ 
			$criteria_tour_tmax3 = new CDbCriteria;
			$criteria_tour_tmax3->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
			$criteria_tour_tmax3->params = array(':cityid' => $town->idseg_cities, ':id_tour_categories' => 3);
			$item->tour_i = SegTourroutes::model()->find($criteria_tour_tmax3)->TNmax;	
		}
			
		//tours
        $criteria_tour = new CDbCriteria;
        $criteria_tour->condition = 'cityid=:cityid';
        $criteria_tour->params = array(':cityid' => $town->idseg_cities);
        $tours = SegTourroutes::model()->findAll($criteria_tour);	
	  
	    if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_view', array(
                'city'=>$town->seg_cityname,
				'id_city'=>$town->idseg_cities,
				'date'=>$date,
				'tours'=>$tours, 
				//'scheduled_array'=>$scheduled_array,
				'city_f'=>$city,
				'date_f'=>$date,
				'time_f'=>$time,
				'language_f'=>$language,
				'guide_f'=>$guide,
				//'pages1'=>$pages1,
				'pages_classic'=>$pages_classic,
				'pages_historical'=>$pages_historical,
				'pages_special'=>$pages_special,
				'scheduled_classic'=>$scheduleds_classic,
				'scheduled_historical'=>$scheduleds_historical,
				'scheduled_special'=>$scheduleds_special,
            ));
            Yii::app()->end();
        } else {
            $this->render('indexn', array(
                'city'=>$town->seg_cityname,
				'id_city'=>$town->idseg_cities,
				'date'=>$date,
				'tours'=>$tours, 
				//'scheduled_array'=>$scheduled_array,
				'city_f'=>$city,
				'date_f'=>$date,
				'time_f'=>$time,
				'language_f'=>$language,
				'guide_f'=>$guide,
				//'pages1'=>$pages1,
				'pages_classic'=>$pages_classic,
				'pages_historical'=>$pages_historical,
				'pages_special'=>$pages_special,
				'scheduled_classic'=>$scheduleds_classic,
				'scheduled_historical'=>$scheduleds_historical,
				'scheduled_special'=>$scheduleds_special,
            ));
        }
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	protected function processPageRequest($param='page')
    {
        if (Yii::app()->request->isAjaxRequest && isset($_POST[$param]))
            $_GET[$param] = Yii::app()->request->getPost($param);
    }

	
}