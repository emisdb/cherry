<?php
class SegScheduledToursController extends Controller
{
	public $layout='//layouts/front_bs';
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('result','city','ajaxLoad', 'index','book','test'),
	       		'roles'=>array('root','guide','office','admin'),  
//				'users'=>array('*'),
			),
		    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('weeks','take','show','admin','admins','spontan','current'),
                'roles'=>array('guide'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('officeadmin','update'),
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



	//OFFICE begin
   	public function actionOfficeadmin()
	{
		$id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide";
        } 
     
        $languages_guide = Languages::model()->findAll();
        
       // $criteria = new CDbCriteria;
       // $criteria->condition = 'guide1_id=:guide1_id';
       // $criteria->params = array(':guide1_id' => $id_control);

        $model=new SegScheduledTours();
  
		$this->render('officeadmin',array(
			'model'=>$model,
			'id_control'=>$id_control,
			'languages_guide'=>$languages_guide,
		));
	}
	
	public function actionUpdate($id)
	{
	    $id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide";
        } 
		
		//language list
		$languages_guide = Languages::model()->findAll();
		//guide list
		$criteria_guide = new CDbCriteria;
        $criteria_guide->condition = 'id_usergroups=:id_usergroups';
        $criteria_guide->params = array(':id_usergroups' => 5);
        $guide_list = User::model()->findAll($criteria_guide);
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegScheduledTours']))
		{
			$model->attributes=$_POST['SegScheduledTours'];
			if($model->save())
				$this->redirect(array('officeadmin'));
		}

		$this->render('update',array(
			'model'=>$model,
			'languages_guide'=>$languages_guide,
			'guide_list'=>$guide_list,
		));
	}
	//end OFFICE

	//GUIDE begin
	
	public function actionBook($id,$cat)
	{
		$model=$this->loadModel($id);
		$tour=$this->loadTR($model->city_id,$cat);
		$contact =  new SegContacts;
		if(isset($_POST['SegScheduledTours']))
		{
			$model->tourroute_id = $cat;
			if(isset($_POST['SegScheduledTours']['language_id']))
				$model->language_id = $_POST['Book']['language_id'];
			if(isset($_POST['SegScheduledTours']['current_subscribers']))
			{
				if(isnull($model->current_subscribers)) $model->current_subscribers=0;
				$model->current_subscribers += $_POST['SegScheduledTours']['current_subscribers'];
			}
				$this->render('result',array(
					'post'=>$_POST,
				));
				return;
		}
		
		$this->render('book',array(
			'model'=>$model,
			'contact'=>$contact,
			'tour'=>$tour,
		));
	}
	public function actionIndex()
	{
	       $model=new SegScheduledTours('search_f');
 			$model->setAttribute("date", date("d-m-Y",time()));
	$this->render('front',array(
				'model'=>$model,
	));
	}
	public function actionTest()
	{
	       $model=new SegScheduledTours('search_f');
 			$model->setAttribute("date", date("d-m-Y",time()));
	$this->render('test',array(
				'model'=>$model,
				'date'=>date("Y-m-d-n-w"),
	));
	}
	public function actionCity($city=null)
	{
        $model=new SegScheduledTours('search_f');
  
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['SegScheduledTours']))
			$model->attributes=$_POST['SegScheduledTours'];
		if(!is_null($city))
			$model->setAttribute("city_id", $city);
		if(empty($model->city_id)) $this->redirect(array("index"));
//			 throw new CHttpException(403,'Must specify a city before performing this action.');
		$tours=new SegTourroutes('search');
		$tours->setAttribute("cityid", $model->city_id);
		$cur_date=0;
		$cur_time=0;

		if(is_null($model->date)) {
			$model->setAttribute("date", date("d-m-Y",time()));
			$cur_date=1;
		}
  
		if(is_null($model->starttime)) {
			$time_bd = date('H:i:s', time()); // now time in hosting
			$cur_time=1;
		}
		else {
//			$criteria_time = new CDbCriteria;
//			$criteria_time->condition = 'idseg_starttimes=:idseg_starttimes';
//			$criteria_time->params = array(':idseg_starttimes' => $model->starttime);
//			$time_bd = SegStarttimes::model()->find($criteria_time)->timevalue;		
			$time_bd=$model->starttime;
		}
		if(($cur_time==1)&&($cur_date==0))
			$model->from_date=date("Y-m-d", strtotime($model->date))." 00:00:00";
		else
			$model->from_date=date("Y-m-d", strtotime($model->date))." ".$time_bd;
		$this->render('city',array(
			'model'=>$model,
			'tours'=>$tours,
		));
//		}

	
	}
	public function actionAjaxLoad()
	{
		$val1 = $_POST;
		$model=new SegScheduledTours('search_f');
//		print_r($val1);
//		return;
		$arr=json_decode($val1['arrdata']);
		if(!empty($arr->city_id)) $model->setAttribute('city_id',$arr->city_id);
		if(!empty($arr->starttime)) $model->setAttribute('starttime',$arr->starttime);
		if(!empty($arr->guide1_id)) $model->setAttribute('guide1_id',$arr->guide1_id);
		if(!empty($arr->date)) $model->setAttribute('date',$arr->date);
		if(!empty($arr->language_id)) $model->setAttribute('language_id',$arr->language_id);
		$cur_time=0;$dt="";
		$date_bd=date('Y-m-d',strtotime($arr->date));
		if(is_null($model->starttime)) {
			$time_bd = date('H:i:s', time()); // now time in hosting
			if ($date_bd!=date('Y-m-d'))	$dt =$date_bd.' 00:00:00';
		}
		else {
			$time_bd=$model->starttime;
		}
		if (strlen($dt)==0)	$dt =$date_bd.' '.$time_bd;
		$model->from_date=$dt;
		$dp=$model->search_f($val1['type']);
		$dp->pagination->currentPage=$val1['page'];
		echo "-".($val1['page']+1)."-";
			 $this->renderPartial('_loop', array('dataProvider'=>$dp,
								'tid'=>$val1['type'],
								'tnmax'=>$val1['tnmax']));
//		print_r ($model->search_f($val1['type'])->getKeys());
        Yii::app()->end();
	}
	public function actionResult()
	{
		if(isset($_POST['Seachmain']['date'])){
			if(($_POST['Seachmain']['date']==null)or($_POST['Seachmain']['date']=='')){
				$date = date('d.m.Y');
			}else{
				$date = $_POST['Seachmain']['date'];
			}
		}else{$date = date('d.m.Y');}
		
		//print_r('88');
		
        if(!isset($_POST['Seachmain']['city'])){
        	$name_city=1;
		} else {
			if($_POST['Seachmain']['city']==0){ $name_city=1;}else{
			$name_city = $_POST['Seachmain']['city'];}
		}
	
		if(isset($_POST['Filter'])){
			$city_f = $_POST['Filter']['city'];
			$date_f = $_POST['Filter']['date_n'];
			$time_f = $_POST['Filter']['time_n'];
			
			
			//print_r($time_f);
			//('888');
			
			
			$language_f = $_POST['Filter']['language'];
			$guide_f = $_POST['Filter']['guide'];
		}else{
			$city_f = null;
			$date_f = null;
			$time_f = null;
			$language_f = null;
			$guide_f = null;
		}
		
		//print_r($city_f);

        if($name_city==1){
            $city_cookie ='city_berlin';
            $date_cookie ='date_berlin';
            $cookie_c=new CHttpCookie($city_cookie,$name_city);
            Yii::app()->request->cookies[$city_cookie]=$cookie_c;
            $cookie_d=new CHttpCookie($date_cookie,$date);
            Yii::app()->request->cookies[$date_cookie]=$cookie_d;
            
            $berlin_link = Yii::app()->createUrl('berlin?city='.$city_f.'&date='.$date_f.'&time='.$time_f.'&language='.$language_f.'&guide='.$guide_f);
            header( 'Location: '.$berlin_link );
        }
        if($name_city==2){
            $city_cookie ='city_munich';
            $date_cookie ='date_munich';
            $cookie_c=new CHttpCookie($city_cookie,$name_city);
            Yii::app()->request->cookies[$city_cookie]=$cookie_c;
            $cookie_d=new CHttpCookie($date_cookie,$date);
            Yii::app()->request->cookies[$date_cookie]=$cookie_d;
            
            $munich_link = Yii::app()->createUrl('munich');
            header( 'Location: '.$munich_link );
        }
        if($name_city=='Dresden'){
            $name_city='Berlin';
            $city_cookie ='city';
            $date_cookie ='date';
            $cookie_c=new CHttpCookie($city_cookie,$name_city);
            Yii::app()->request->cookies[$city_cookie]=$cookie_c;
            $cookie_d=new CHttpCookie($date_cookie,$date);
            Yii::app()->request->cookies[$date_cookie]=$cookie_d;
            
            $dresden_link = Yii::app()->createUrl('dresden');
            header( 'Location: '.$dresden_link );
        }
        if($name_city=='Stuttgart'){
            $name_city='Berlin';
            $city_cookie ='city';
            $date_cookie ='date';
            $cookie_c=new CHttpCookie($city_cookie,$name_city);
            Yii::app()->request->cookies[$city_cookie]=$cookie_c;
            $cookie_d=new CHttpCookie($date_cookie,$date);
            Yii::app()->request->cookies[$date_cookie]=$cookie_d;
            
            $stuttgart_link = Yii::app()->createUrl('stuttgart');
            header( 'Location: '.$stuttgart_link );
        }
        if($name_city=='Augsburg'){
            $name_city='Berlin';
            $city_cookie ='city';
            $date_cookie ='date';
            $cookie_c=new CHttpCookie($city_cookie,$name_city);
            Yii::app()->request->cookies[$city_cookie]=$cookie_c;
            $cookie_d=new CHttpCookie($date_cookie,$date);
            Yii::app()->request->cookies[$date_cookie]=$cookie_d;
            
            $augsburg_link = Yii::app()->createUrl('augsburg');
            header( 'Location: '.$augsburg_link );
        }
        if($name_city=='Regensburg'){
            $name_city='Berlin';
            $city_cookie ='city';
            $date_cookie ='date';
            $cookie_c=new CHttpCookie($city_cookie,$name_city);
            Yii::app()->request->cookies[$city_cookie]=$cookie_c;
            $cookie_d=new CHttpCookie($date_cookie,$date);
            Yii::app()->request->cookies[$date_cookie]=$cookie_d;
            
            $regensburg_link = Yii::app()->createUrl('regensburg');
            header( 'Location: '.$regensburg_link );
        }
        if($name_city=='Koln'){
            $name_city='Berlin';
            $city_cookie ='city';
            $date_cookie ='date';
            $cookie_c=new CHttpCookie($city_cookie,$name_city);
            Yii::app()->request->cookies[$city_cookie]=$cookie_c;
            $cookie_d=new CHttpCookie($date_cookie,$date);
            Yii::app()->request->cookies[$date_cookie]=$cookie_d;
            
            $koln_link = Yii::app()->createUrl('koln');
            header( 'Location: '.$koln_link );
        }
    }

	public function actionShow($id)
	{
	    $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide";
        }   
        
       	$model=$this->loadModel($id);
        
        //city
        //$citie->seg_cityname = '';
        $j=0;
        $criteria_city = new CDbCriteria;
        $criteria_city->condition = 'users_id=:users_id';
        $criteria_city->params = array(':users_id' => $model->guide1_id);
        $city = SegGuidesCities::model()->find($criteria_city);
        if(isset($city)){
            $criteria_c = new CDbCriteria;
            $criteria_c->condition = 'idseg_cities=:idseg_cities';
            $criteria_c->params = array(':idseg_cities' => $city->cities_id);
            $citie = SegCities::model()->find($criteria_c);
            
            $model->city_id_all = $citie->seg_cityname;
            $j = $citie->idseg_cities;
        }else{
            $model->city_id_all = 'no element';
        }
        
        //language
        if($model->language_id==NULL){
            $i=0;
            $criteria_language = new CDbCriteria;
            $criteria_language->condition = 'users_id=:users_id';
            $criteria_language->params = array(':users_id' => $model->guide1_id);
            $language = SegLanguagesGuides::model()->findAll($criteria_language);
            if(isset($language)){
                foreach($language as $item){
                    $criteria_i = new CDbCriteria;
                    $criteria_i->condition = 'id_languages=:id_languages';
                    $criteria_i->params = array(':id_languages' => $item->languages_id);
                    $languages = Languages::model()->findAll($criteria_i);
                    $model->language_id_all[$i] = $languages;
                    $i++;
                }
            }else{
                $model->language_id_all[0] = 'no element';
            }
        }else{
            $criteria_i = new CDbCriteria;
            $criteria_i->condition = 'id_languages=:id_languages';
            $criteria_i->params = array(':id_languages' => $model->language_id);
            $language = Languages::model()->find($criteria_i);
            $model->language_id_all[0] = $language;
        }
               
        //tour canegories + tourroute
        //$tourroute_id_all;
        $z=0;
        $criteria_tour = new CDbCriteria;
        $criteria_tour->condition = 'usersid=:usersid';
        $criteria_tour->params = array(':usersid' => $model->guide1_id);

        $tourcats = SegGuidesTourroutes::model()->findAll($criteria_tour);
        if(isset($tourcats)){
            foreach($tourcats as $tourroute){
                $criteria_t = new CDbCriteria;
                $criteria_t->condition = 'id_tour_categories=:id_tour_categories AND cityid=:cityid';
                $criteria_t->params = array(':id_tour_categories' => $tourroute->tourroutes_id, ':cityid'=>$j);
                $tourroutes = SegTourroutes::model()->find($criteria_t);
                $model->tourroute_id_all[$z] = $tourroutes->name;
                $z++;           
    }
            
            
            
        }else{
              $model->tourroute_id_all[0] = 'no element';
        }
        
        $this->render('show',array('model'=>$model));
         

    }

	public function actionWeeks($date)
	{
	    $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide";
        }    
        
        
        //city work
        $criteria_city = new CDbCriteria;
        $criteria_city->condition = 'users_id=:users_id';
        $criteria_city->params = array(':users_id' => $id_control);
        $id_city = SegGuidesCities::model()->find($criteria_city)->cities_id;
          
        
        $model_week = array(); $i=0;$status_old ='';
        $start_times_tour =SegStarttimes::model()->findAll(); 
        foreach($start_times_tour as $item){
            $day = new DayResult;
            $day->time = $item->timevalue;
            
            $date_format =  strtotime($date);
            $criteria = new CDbCriteria;
            $criteria->condition = 'original_starttime=:original_starttime AND date_now=:date_now AND city_id=:city_id';
            $criteria->params = array(':original_starttime' => $item->timevalue,':date_now'=>$date_format,':city_id'=>$id_city);
            $scheduled_item = SegScheduledTours::model()->find($criteria);
            if(isset($scheduled_item)){
                $day->id = $scheduled_item->idseg_scheduled_tours;
                $day->starttime = $scheduled_item->starttime;
                if($scheduled_item->guide1_id == $id_control){
                    //if($scheduled_item->current_subscribers>0){
                    //    $day->status ='Belegt, braucht aber einen Guide';
                    //}else{
                        $day->status ='Belegt, Deine Tour!';
                    //}
                }else{
                    $day->status ='Belegt';
                }
            }else{
                $day->id = 0;
                $day->status = 'frei!';
            }
            if($status_old=='Belegt, Deine Tour!'){
                $day->status ='Block';
                
                
                
            }
            $status_old = $day->status;
            if($day->status == 'Belegt, Deine Tour!'){
                if($i!=0)$model_week[$i-1]->status = 'Block';
            }
            //$day_id_old1 = $day->id;
            //$day_id_old2 = $day->id;
            
            
           // $day->status = 1;
            $model_week[$i] = $day;
            $i++;
       }
      // $model=new CActiveDataProvider($model_week);
      //  $date_format = date('Y-m-d', strtotime($date));
        
		$this->render('weeks',array('date'=>$date, 'model'=>$model_week));
	}

	public function actionTake($date,$time)
	{
	    $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $user_control = User::model()->findByPk($id_control);  
        $role_control = $user_control->id_usergroups;    
        // $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide"; 
        } 
        
        if($role_control==5){
            $date_format =  strtotime($date);
            $date_bd = date('Y-m-d',$date_format);
			
            $criteria_city = new CDbCriteria;
            $criteria_city->condition = 'users_id=:users_id';
            $criteria_city->params = array(':users_id' => $id_control);
            $id_city = SegGuidesCities::model()->find($criteria_city)->cities_id;
  
                $scheduled_item = new SegScheduledTours;
                $scheduled_item->starttime = $time;
                $scheduled_item->date_now = $date_format;
				$scheduled_item->date = $date_bd;
                $scheduled_item->guide1_id = $id_control;
                $scheduled_item->original_starttime = $time;
                $scheduled_item->visibility = 1;
               // $scheduled_item->tourroute_id =  $tour_schel;//???????????????????????????
                $scheduled_item->city_id = $id_city;
                $scheduled_item->save();
                $this->redirect( Yii::app()->createUrl('segScheduledTours/weeks',array('date'=>$date)) );
        }else{
            
            
        }    
    }

	public function actionSpontan()
	{
 		$id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $user_control = User::model()->findByPk($id_control);  
        $role_control = $user_control->id_usergroups;    
        // $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide"; 
        } 
		$model=new SegScheduledTours;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegScheduledTours']))
		{
			//$model->attributes=$_POST['SegScheduledTours'];
			$datetime = strtotime($_POST['SegScheduledTours']['date_time']);
			$date_bd = date('Y-m-d',$datetime);
			//starttime
			$model->starttime = date('H:i:s',$datetime);
			//date_now
			$model->date_now = strtotime(date('d.m.Y',$datetime));
			$model->date = $date_bd;
			//guide1_id
			$model->guide1_id = $id_control;
			//original_starttime
			$model->original_starttime = '00:00:00';
			//visibility
			$model->visibility = 1;
			//city_id
			$criteria = new CDbCriteria;
            $criteria->condition = 'users_id=:users_id';
            $criteria->params = array(':users_id' => $id_control);
            $model->city_id = SegGuidesCities::model()->find($criteria)->cities_id;
			
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('spontan',array(
			'model'=>$model,
		));
		
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	   $this->layout = "admin";
		$model=new SegScheduledTours;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegScheduledTours']))
		{
			$model->attributes=$_POST['SegScheduledTours'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_scheduled_tours));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */


	/**
	 * Manages all models.
	 */
	public function actionAdmins()
	{
		$model=new SegScheduledTours('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegScheduledTours']))
			$model->attributes=$_GET['SegScheduledTours'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionAdmin()
	{
	   $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 
        if($role_control==5){
            $this->layout = "guide";
        } 
     
        
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'guide1_id=:guide1_id';
        $criteria->params = array(':guide1_id' => $id_control);
        //$//criteria->order = '(date_now DESC) AND (starttime DESC)';
        // $criteria->order = 'starttime DESC';
      //  $model = SegScheduledTours::model()->findAll($criteria);
     //  print_r($model);
     //   $dataProvider =  new CActiveDataProvider($model, array(
		//	'criteria'=>$criteria,
      //  'id'=>'idseg_scheduled_tours',
      //      'sort'=>array(
      //          'attributes'=>array(
     //                  'date_now', 'starttime',
     //           ),
     //       ),
	//	));
     //   $mmm=$dataProvider->getData();
       // $model=new SegScheduledTours('search_s',array('id_guide1'=>$id_control));
        
        	$model=new SegScheduledTours();
  
		/*$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegScheduledTours']))
			$model->attributes=$_GET['SegScheduledTours'];*/

		$this->render('admin',array(
			'model'=>$model,'id_control'=>$id_control
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SegScheduledTours the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SegScheduledTours::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadTR($id,$cat)
	{
		$model=SegTourroutes::model()->findByAttributes(array('cityid'=>$id,'id_tour_categories'=>$cat));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param SegScheduledTours $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seg-scheduled-tours-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
