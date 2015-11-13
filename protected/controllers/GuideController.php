<?php

class GuideController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/guide_bs';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('test'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','profile','update','contact','user','weeks','take','show','book',
					'ajaxShow','ajaxHistory','schedule','history','cash','createCash','createpdf','current','deleteST','delete'),
                'roles'=>array('guide'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function filterGuideContext($filterChain)
	{
		$filterChain->run();
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadGuide($id),
		));
	}
	public function actionSystem()
	{
		$this->render('system',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SegBookings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegBookings']))
		{
			$model->attributes=$_POST['SegBookings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_bookings));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegBookings']))
		{
			$model->attributes=$_POST['SegBookings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_bookings));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadST($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('schedule'));
	}
	public function actionDeleteST($id,$date)
	{
		$this->loadST($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('schedule','date'=>$date));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SegBookings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionTest()
	{
		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
//		$test=$this->loadModel();
		$this->render('test',array(
			'info'=>$test,
		));
	}
   public function actionProfile()
	{

        $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
        //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        
        $id = Yii::app()->user->id;
        $model=$this->loadUser($id);
		
		/*CASH*/
		if($role_control==5){
			//guidesdata
			$user = User::model()->findByPk($id);
  			$guidesdata = SegGuidesdata::model()->findByPk($user->id_guide);

			//segguidestourroutes
			$criteria_t=new CDbCriteria;
			$criteria_t->condition='usersid=:usersid';
			$criteria_t->params=array(':usersid'=>$id);
			$link_tourroutes = SegGuidesTourroutes::model()->findAll($criteria_t);
	
			$array_tour = array();
			$array_tour_link = array();
			if(isset($link_tourroutes)) {
				
				$criteria_a=new CDbCriteria;
				$criteria_a->condition='users_id=:users_id';
				$criteria_a->params=array(':users_id'=>$id);
				$a = SegGuidesCities::model()->find($criteria_a)->cities_id;
				$i=0;
			
				foreach($link_tourroutes as $item) {
					$b = $item->tourroutes_id;
					$criteria_tour=new CDbCriteria;
					$criteria_tour->condition='id_tour_categories=:id_tour_categories AND cityid=:cityid';
					$criteria_tour->params=array(':id_tour_categories'=>$b,'cityid'=>$a);
					$tourroute = SegTourroutes::model()->find($criteria_tour);
					$array_tour[$i] = 	$tourroute;
					$array_tour_link[$i] = $item;
					
					if($i==0) {
						$array_tour_link[$i]->base_provision0 = $item->base_provision;
						$array_tour_link[$i]->guest_variable0 = $item->guest_variable;
						$array_tour_link[$i]->guestsMinforVariable0 = $item->guestsMinforVariable;
						$array_tour_link[$i]->voucher_provision0 = $item->voucher_provision;
					}
					if($i==1) {
						$array_tour_link[$i]->base_provision1 = $item->base_provision;
						$array_tour_link[$i]->guest_variable1 = $item->guest_variable;
						$array_tour_link[$i]->guestsMinforVariable1 = $item->guestsMinforVariable;
						$array_tour_link[$i]->voucher_provision1 = $item->voucher_provision;
					}
					if($i==2) {
						$array_tour_link[$i]->base_provision2 = $item->base_provision;
						$array_tour_link[$i]->guest_variable2 = $item->guest_variable;
						$array_tour_link[$i]->guestsMinforVariable2 = $item->guestsMinforVariable;
						$array_tour_link[$i]->voucher_provision2 = $item->voucher_provision;
					}
					$i++;
				}
			}
		}
              
        /*CITY*/
        $criteria_city = new CDbCriteria;
        $criteria_city->condition = 'users_id=:users_id';
        $criteria_city->params = array(':users_id' => $id);
        $city_link = SegGuidesCities::model()->find($criteria_city);
       
        $city='';
        if(isset($city_link))$city = SegCities::model()->findByPk($city_link->cities_id);

        /*TOUR*/
        $criteria = new CDbCriteria;
        $criteria->condition = 'usersid=:usersid';
        $criteria->params = array(':usersid' => $id);
        $tourcat = SegGuidesTourroutes::model()->findAll($criteria);

        $tour_categories_user='';
        if(isset($tourcat)){
            $j=0;
            foreach($tourcat as $tourcat_item){
                $model_tour = new TourUser;
                
                $criteria_tourcat = new CDbCriteria;
                $criteria_tourcat->condition = 'id_tour_categories=:id_tour_categories';
                $criteria_tourcat->params = array(':id_tour_categories' => $tourcat_item->tourroutes_id);
                $name_tourcat = TourCategories::model()->find($criteria_tourcat);
                $model_tour->cat = $name_tourcat->name;
                
                $criteria_tour = new CDbCriteria;
                $criteria_tour->condition = 'id_tour_categories=:id_tour_categories AND cityid=:cityid';
                $criteria_tour->params = array(':id_tour_categories' => $tourcat_item->tourroutes_id, ':cityid' => $city->idseg_cities);
                $tour = SegTourroutes::model()->find($criteria_tour);
                $model_tour->tourname = $tour->name;
                
                $tour_categories_user[$j]=$model_tour;
                $j++;
            }
        }else{$tourcat='';}
        
        /*LANGUADGE*/
        $criteria_lan = new CDbCriteria;
        $criteria_lan->condition = 'users_id=:users_id';
        $criteria_lan->params = array(':users_id' => $id);
        $lancat = SegLanguagesGuides::model()->findAll($criteria_lan);
        
        $lan_ob_user='';
        if(isset($lancat)){
            $i=0;
            foreach($lancat as $lancat_item){
                $criteria_lani = new CDbCriteria;
                $criteria_lani->condition = 'id_languages=:id_languages';
                $criteria_lani->params = array(':id_languages' => $lancat_item->languages_id);
                $lan_ob = Languages::model()->find($criteria_lani);
                $lan_ob_user[$i]=$lan_ob;
                $i++;
            }
        }else{$lancat='';}
		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		if($role_control==5){
			 $this->render('profile',array(
				'model'=>$model,
				'tourcat'=>$tour_categories_user,
				'lan_obs'=>$lan_ob_user, 
				'city'=>$city,
				/*cash*/
				'link_tourroutes'=>$link_tourroutes,
				'guidesdata'=>$guidesdata,
				'user'=>$user,
				'array_tour' => $array_tour,
				'array_tour_link' => $array_tour_link,
			'info'=>$test,
			));
		} else{	
			$this->render('profile',array(
				'model'=>$model,
				'tourcat'=>$tour_categories_user,
				'lan_obs'=>$lan_ob_user, 
				'city'=>$city,
			'info'=>$test,
			));
		}
    }
	public function actionUser($id)
	{
        $id_control = Yii::app()->user->id;
        $role_control = $this->loadUser($id_control)->id_usergroups; 

        //update access
        $is_control=0;
        $role_update = $this->loadUser($id)->id_usergroups; 
        if($id_control==$id) $is_control = 1;
        if($role_control==1) $is_control = 1;
        if(($role_control==2)and($role_update<>1)) $is_control = 1;
        if(($role_control==3)and($role_update<>1)and($role_update<>2)) $is_control = 1;   
      		$model=$this->loadUser($id);
    
    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
  		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
    		if(isset($_POST['User']))
    		{
    			$model->attributes=$_POST['User'];
               // $model->id_usergroups = $_POST['User']['role_ob'];
    			if($model->save())
    				if($id==$id_control){
    				    $this->redirect(array('profile'));
                    } else {
                        $this->redirect(array('admin'));
                    }
    		}
    
    		$this->render('user',array(
    			'model'=>$model,//,'usergroups'=>$usergroups
  			'info'=>$test,
  		));
        
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionContact($id,$id_user)
	{
	    $id_control = Yii::app()->user->id;
        $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;  
        
        
        $is_control=0;
        $role_update = $update_user->id_usergroups; 
        if($id_control==$id) $is_control = 1;
        if($role_control==1) $is_control = 1;
        if(($role_control==2)and($role_update!=1)and($role_update!=2)) $is_control = 1;
        if(($role_control==3)and($role_update!=1)and($role_update!=2)and($role_update!=3)) $is_control = 1;   
        if($id_control==$id_user)$is_control = 1;
          //print_r('777'.$is_control);
        
 			$criteria = new CDbCriteria;
        	$criteria->condition = 'id=:id';
        	$criteria->params = array(':id' => $id_user);
        	$id_contact = User::model()->find($criteria)->id_contact;
			
    		$model=$this->loadContact($id_contact);
    
    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
    
    		if(isset($_POST['SegContacts']))
    		{
    			$model->attributes=$_POST['SegContacts'];
                //print_r($model->birthdate);
               // $model->birthdate = date('Y-m-d',strtotime($model->birthdate));
               // print_r($model->birthdate);
    			if($model->save())
    				if($id_control!=$id_user){
    				    $this->redirect(array('contact','id'=>$id_user));
                    } else{
                        $this->redirect(array('profile'));
                    }
    		}
  		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
    		$this->render('contact',array(
    			'model'=>$model,'id_user'=>$id_user,
				'update_user'=>$update_user,
  			'info'=>$test,
				));
  }
	public function actionWeeks($date,$err=null)
	{
	    $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
 
        //city work
        $criteria_city = new CDbCriteria;
        $criteria_city->condition = 'users_id=:users_id';
        $criteria_city->params = array(':users_id' => $id_control);
        $city = SegGuidesCities::model()->with('cities')->find($criteria_city);
		          
        
        $model_week = array(); $i=0;$status_old ='';
        $start_times_tour =SegStarttimes::model()->findAll(); 
        foreach($start_times_tour as $item){
            $day = new DayResult;
            $day->time = $item->timevalue;
            
            $date_format =  strtotime($date);
            $criteria = new CDbCriteria;
            $criteria->condition = 'original_starttime=:original_starttime AND date_now=:date_now AND city_id=:city_id';
            $criteria->params = array(':original_starttime' => $item->timevalue,':date_now'=>$date_format,':city_id'=>$city->cities->idseg_cities);
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
            if(($status_old=='Belegt, Deine Tour!')&&($day->status == 'frei!')){
                $day->status ='Block after';
             }
            if($day->status == 'Belegt, Deine Tour!'){
                if($i!=0){
					if($status_old=='frei!')
					$model_week[$i-1]->status = 'Block before';
				}

            }
 			  $status_old = $day->status;
			  //$day_id_old1 = $day->id;
            //$day_id_old2 = $day->id;
            
            
           // $day->status = 1;
            $model_week[$i] = $day;
            $i++;
       }
      // $model=new CActiveDataProvider($model_week);
      //  $date_format = date('Y-m-d', strtotime($date));
  		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
       
		$this->render('weeks',array(
			'date'=>$date, 
			'model'=>$model_week,
 			'info'=>$test,
 			'city'=>$city,
 			'err'=>$err,
				));
	}

	public function actionTake($date,$time,$spont=0)
	{
	    $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
 			$arrtime=explode(":",$time);
			$ortime=$arrtime[0].":00:00";
         
            $date_format =  strtotime($date);
            $date_bd = date('Y-m-d',$date_format);
			$err="";
			if($spont>0)
			{
		      $criteria = new CDbCriteria;
			  $criteria->condition = 'original_starttime=:original_starttime AND date_now=:date_now AND guide1_id=:guide_id';
            $criteria->params = array(':original_starttime' => $ortime,':date_now'=>$date_format,':guide_id'=>$id_control);
            $scheduled_item = SegScheduledTours::model()->find($criteria);
			if($scheduled_item){
				$err=$time;
				$this->redirect( Yii::app()->createUrl('guide/weeks',array('date'=>$date,'err'=>$err)) );
			}
 
			}
			
            $criteria_city = new CDbCriteria;
            $criteria_city->condition = 'users_id=:users_id';
            $criteria_city->params = array(':users_id' => $id_control);
            $id_city = SegGuidesCities::model()->find($criteria_city)->cities_id;
  
                $scheduled_item = new SegScheduledTours;
                $scheduled_item->starttime = $time;
                $scheduled_item->date_now = $date_format;
				$scheduled_item->date = $date_bd;
                $scheduled_item->guide1_id = $id_control;
                $scheduled_item->original_starttime = $ortime;
                $scheduled_item->visibility = 1;
               // $scheduled_item->tourroute_id =  $tour_schel;//???????????????????????????
                $scheduled_item->city_id = $id_city;
                $scheduled_item->save();
                $this->redirect( Yii::app()->createUrl('guide/weeks',array('date'=>$date)) );
   
    }

	public function actionShow($id)
	{
	    $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         	$model=$this->loadST($id);
        
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
   		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
        
        $this->render('show',array('model'=>$model,'info'=>$test,));
         

    }
	public function actionAjaxShow()
	{
		if (!Yii::app()->request->isAjaxRequest)
			{
				echo "No data";
				exit;               
			}

	 	$id= $_POST['id'];
		    $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         	$model=$this->loadST($id);
        
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
        
 		$result=$this->renderPartial('ajaxshow',array('model'=>$model));
         

    }
	public function actionSchedule($date=null)
	{
	   $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
       
        
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'guide1_id=:guide1_id';
        $criteria->params = array(':guide1_id' => $id_control);
		if(is_null($date))   $Datef= date('Y-m-d');
		else   $Datef= date('Y-m-d', strtotime($date));
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
		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 
		$this->render('schedule',array(
			'model'=>$model,'id_control'=>$id_control,'info'=>$test,'date'=> $Datef,
		));
	}
	
	public function actionCash()
	{
		$id_control = Yii::app()->user->id;
		$guide = User::model()->findByPk($id_control);
	$dataProvider=new CActiveDataProvider('CashboxChangeRequests',
	array('criteria'=>array(
		'condition'=>'id_users=:id_users',
		'params'=>array(':id_users'=>$id_control),
	    'order'=>'request_date DESC',
	),
		'pagination'=>array(
		'pageSize'=>30,),
		));
		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 	
			$this->render('cash_index',array(
				'dataProvider'=>$dataProvider,
				'info'=>$test
		));
	}
		public function actionCreateCash()
	{
		$model=new CashboxChangeRequests;
		$id_control = Yii::app()->user->id;
		$model->id_users=$id_control;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CashboxChangeRequests']))
		{
			$model->attributes=$_POST['CashboxChangeRequests'];
			if($model->save())
				$this->redirect(array('cash'));
		}

		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 		$this->render('cash_create',array(
			'model'=>$model,
			'info'=>$test
		));
	}

	public function actionHistory($id)
	{
		$id_control = Yii::app()->user->id;
		$guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
    		
		$criteria = new CDbCriteria;
		$criteria->condition = 'users_id=:users_id';
		$criteria->params = array(':users_id'=>$id);
		$history = CashboxHistory::model()->findAll($criteria);
		
		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 	$this->render('history',array(
			'history'=>$history,'info'=>$test
		));
	}
		public function actionAjaxHistory()
	{
			if (!Yii::app()->request->isAjaxRequest)
			{
				echo "No data";
				exit;               
			}

	 	$id= $_POST['id'];
		$id_control = Yii::app()->user->id;
		$guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
    		$item = $this->loadHistory($id);
		
		$criteria_guide = new CDbCriteria;
        $criteria_guide->condition = 'id=:id';
        $criteria_guide->params = array(':id' => $item->users_id);
		$guide = User::model()->find($criteria_guide);
		$guide_name = $guide->username;
		$guide_id = $guide->id;
		
		$criteria_tour = new CDbCriteria;
        $criteria_tour->condition = 'idseg_scheduled_tours=:idseg_scheduled_tours';
        $criteria_tour->params = array(':idseg_scheduled_tours' => $item->id_sched);
		$tour_id = SegScheduledTours::model()->find($criteria_tour)->tourroute_id;
		
		$criteria_tour = new CDbCriteria;
        $criteria_tour->condition = 'id_sched=:id_sched';
        $criteria_tour->params = array(':id_sched' => $item->id_sched);
		$invoice_name = SegGuidestourinvoices::model()->find($criteria_tour)->TA_string;

		$this->renderPartial('view_hd',array(
			'guide_name'=>$guide_name,
			'guide_id'=>$guide_id,
			'tour_id'=>$tour_id,
			'invoice_name'=>$invoice_name,
			'item'=>$item,
		));
	}
	public function actionCurrent($id_sched)
	{
	
		$id_control = Yii::app()->user->id;
        $guide = User::model()->findByPk($id_control);
		$sched = SegScheduledTours::model()->with(array('guidestourinvoices'=>array('guidestourinvoicescustomers','contact')))->findByPk($id_sched);
		if(is_null($sched)) 	throw new CHttpException(404,'The requested tour does not exist.');

 
  			$date_format = strtotime($sched->date);
			$date_bd = date('Y-m-d',$date_format);
			$dt =$date_bd.' '.$sched->starttime;
	
			//mainoption

			$criteria_vat = new CDbCriteria;
			$criteria_vat->condition = 'name=:name ';
			$criteria_vat->params = array(':name'=>'Vat');
			$vat_nds = Mainoptions::model()->find($criteria_vat)->value;
			$criteria = new CDbCriteria;
			$criteria->condition = 'idpayoptions=:idpayoptions1 OR idpayoptions=:idpayoptions2 OR idpayoptions=:idpayoptions3';
			$criteria->params = array(':idpayoptions1' => 1,':idpayoptions2' => 2,':idpayoptions3' => 3);
			$pay = Payoptions::model()->findAll($criteria);
			$invoiceoptions_array = Invoiceoptions::model()->findAll(array('order'=>'id ASC')); 
			$dis = Bonus::model()->findAll(array('order'=>'sort ASC')); 
				if(!empty($_POST))
				{
//					$newcustomer=$_POST['new_customer'];
//					if($newcustomer>0)
//					{
//						if(count($model)>0)
//						{
//							$customer = new SegGuidestourinvoicescustomers;
////							$customer->setAttributes($model[0]->attributes, true);
//							$customer->customersName = $model[0]->customersName;
//							$customer->price = $model[0]->price;
//							$customer->cityid = $model[0]->cityid;					
//							$customer->tourInvoiceid =  $model[0]->tourInvoiceid ;
//							$max= Yii::app()->db->createCommand("SELECT max(CustomerInvoiceNumber) from seg_guidestourinvoicescustomers where cityid=".$customer->cityid)->queryScalar();
//							$max_i = $max+1;
//							$splitstr=  explode("/",$model[0]->KA_string);
//							$customer->KA_string = $splitstr[0]."/".$max_i;
//							$customer->CustomerInvoiceNumber = $max_i;
//							$customer->isPaid = 0;
//							$customer->origin_booking = $model[0]->origin_booking ;
//							$customer->save();
//							$model = SegGuidestourinvoicescustomers::model()->findAll($criteria_invoicecustomer);
//							
//						}
//					}
//					else
//					{
					//create guidetourinvoice
					//проверка на существование invoice
				foreach ($sched->guidestourinvoices as $invoice) {
					$model=$invoice->guidestourinvoicescustomers;
					$count_cust=0;
					$overAllIncome=0;
					$cashIncome=0;
					$invoice_id =  $invoice->idseg_guidesTourInvoices;
//			
					for($k=0;$k<count($model);$k++)
					{
					
						$kk=$model[$k]->idseg_guidesTourInvoicesCustomers;
						$count_cust++;
						$model[$k]->tourInvoiceid = $invoice_id;
						$model[$k]->customersName = $_POST['customersName'.$kk];
						$model[$k]->discounttype_id = $_POST['discounttype_id'.$kk];
						$model[$k]->paymentoptionid = $_POST['payoption'.$kk];
						if(!empty($_POST['price'.$kk])) {
							$model[$k]->price = $_POST['price'.$kk];
						}
						$overAllIncome+=is_null($model[$k]->price)? 0 : $model[$k]->price;
						if($model[$k]->paymentoptionid==1) $cashIncome+=is_null($model[$k]->price)? 0 : $model[$k]->price;
						$model[$k]->id_invoiceoptions = $_POST['option'.$kk];
						if($model[$k]->paymentoptionid)$model[$k]->isPaid = 1;
					
						$model[$k]->save();
						
					}
					$invoice->creationDate = $sched->date;
					$invoice->cityid = $sched->city_id;
					$invoice->sched_tourid = $sched->tourroute_id;
					$invoice->guideNr = $sched->guide1_id;
					$invoice->status = 0;
					$invoice->id_sched = $sched->idseg_scheduled_tours;
					$invoice->overAllIncome = $overAllIncome;
					$invoice->cashIncome =  $cashIncome;
					$invoice->save();
				}
			}
//		}
	$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('current',array(
//					'model'=>$model,
		'guide'=>$guide,
		'sched'=>$sched,
		'id_sched'=>$id_sched,
		'vat_nds'=>$vat_nds,
		'pay'=>$pay,
		'dis'=>$dis,
		'invoiceoptions_array'=>$invoiceoptions_array,
		'info'=>$test,
	));

	
	}
    public function actionBook($id_sched)
	{
        $scheduled = SegScheduledTours::model()->findByPk($id_sched);
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
			$criteria = new CDbCriteria;
			 $criteria->condition = 'cityid=:cityid AND idseg_tourroutes=:id_tour_categories';
			 $criteria->params = array(':cityid' => $scheduled->city_id,':id_tour_categories'=>$scheduled->tourroute_id);
			 $tour = SegTourroutes::model()->find($criteria);
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
        
        //$model = new SegContacts;
        
        $contact = new Bookq;
        
       	if(isset($_POST['Bookq']))
		{
			if(is_null($scheduled->tourroute_id))
			{
				$scheduled->tourroute_id = $_POST['Bookq']['tour'];
				$scheduled->language_id = $_POST['Bookq']['language'];
			}
			$contact->attributes=$_POST['Bookq'];
			
			$ticket_array = SegTourroutes::model()->findByPk($scheduled->tourroute_id);
			
			$cat_i = $_POST['Bookq']['cat_hidden'];
			if($cat_i == 1)$ticket_count = $_POST['Bookq']['tickets1'];
			if($cat_i == 2)$ticket_count = $_POST['Bookq']['tickets2'];
			if($cat_i == 3)$ticket_count = $_POST['Bookq']['tickets3'];
			$contact->tickets = $ticket_count; 
           if($contact->validate()){
								
				//save contact
				$user_contact =  new SegContacts;
				$user_contact->firstname = $_POST['Bookq']['firstname'];
				$user_contact->surname = $_POST['Bookq']['lastname'];
				$user_contact->additional_address = $_POST['Bookq']['additional_address'];
				$user_contact->city = $_POST['Bookq']['city'];
				$user_contact->street = $_POST['Bookq']['street'];
				$user_contact->postalcode = $_POST['Bookq']['postalcode'];
				$user_contact->house = $_POST['Bookq']['house'];
				$user_contact->country = $_POST['Bookq']['country'];
				$user_contact->phone = $_POST['Bookq']['phone'];
				$user_contact->email = $_POST['Bookq']['email'];
				$user_contact->save();
				
				//save booking
				$id_user = $user_contact->idcontacts;
//				$current = new SegBookqings;
//				$current->customer_id = $id_user;
//				$current->groupsize = $ticket_count;
//				$current->sched_tourid = $id;
//				$current->save();
//
//				$id_book = $current->idseg_bookings;
				
				
				//save guidestourinvoice
				$guidestourinvoices = new SegGuidestourinvoices;
		
			
				$guidestourinvoices->creationDate = $scheduled->date;
				$guidestourinvoices->cityid = $scheduled->city_id;
				$guidestourinvoices->sched_tourid = $scheduled->tourroute_id;
				$guidestourinvoices->guideNr = $scheduled->guide1_id;
				$guidestourinvoices->status = 0;
				$guidestourinvoices->contacts_id = $id_user;
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
					$max= Yii::app()->db->createCommand("SELECT max(CustomerInvoiceNumber) from seg_guidestourinvoicescustomers where cityid=".$scheduled->city_id)->queryScalar();
					$max_i = $max+1;
					
					$guidestourinvoicescustomers->KA_string = 'KA'.$b.$year.'/'.$max_i;
					$guidestourinvoicescustomers->CustomerInvoiceNumber = $max_i;
					$guidestourinvoicescustomers->isPaid = 0;
//					$guidestourinvoicescustomers->origin_booking = $id_book;
					
					
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
//				if ($this->sendMail($to, $name_forms, $message))
				{
					$this->redirect(array('current','id_sched'=>$id_sched));
				
				}
			}
		}
		
//		$criteria_cat = new CDbCriteria;
//        $criteria_cat->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
//        $criteria_cat->params = array(':cityid' => $scheduled->city_id,':id_tour_categories'=>$cat);
//		$cat_item = SegTourroutes::model()->find($criteria_cat)->idseg_tourroutes;

				
		$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

        $this->render('book',array(
			'scheduled'=>$scheduled,
			'contact'=>$contact,
			'tour'=>$tour,
			'tours_guide'=>$tours_guide,
			'languages_guide'=>$languages_guide,
			'info'=>$test,

				));
    } 
	public function actionCreatepdf($id_sched)
	{
		
		$id_control = Yii::app()->user->id;
        $guide = User::model()->with('contact_ob')->findByPk($id_control);
		$sched = SegScheduledTours::model()->with(array('guidestourinvoices'=>array('guidestourinvoicescustomers','contact')))->findByPk($id_sched);
		if(is_null($sched)) 	throw new CHttpException(404,'The requested tour does not exist.');
	
		$date_format = strtotime($sched->date);
		$date_bd = date('Y-m-d',$date_format);
		$dt =$date_bd.' '.$sched->starttime;
		$tour = SegTourroutes::model()->findByPk($sched->tourroute_id);
		$mails=array();
		$fn='.'; $ln='.';
		if((!is_null($guide->contact_ob['firstname'])) && $guide->contact_ob['firstname']!=''){$fn = $guide->contact_ob['firstname']{0};}else{$fn='0';}
		if((!is_null($guide->contact_ob['surname'])) && $guide->contact_ob['surname']!=''){$ln = $guide->contact_ob['surname']{0};}else{$ln='0';}
		$c = $tour->city['seg_cityname']{0};
		$year = date('y',time());
		$num=0;
		$criteria_i = new CDbCriteria;
		$criteria_i->condition = 'guide1_id=:guide1_id AND openTour=:openTour';
		$criteria_i->params = array(':guide1_id'=>$id_control,'openTour'=>1);
		$schedall = SegScheduledTours::model()->findAll($criteria_i);
		foreach($schedall as $item){
				$year_item = date('y',$item->date_now);
				if($year_item == $year){
					$num++;
				}
			}
		$num = $num+1;
		$sched->GN_string = $fn.$ln.$c.'/'.$id_control.'/'.$year.'/'.$num;		
		$sched->openTour = 1;//create pdf
			//tourroutes
		$criteria_tourroutes = new CDbCriteria;
		$criteria_tourroutes->condition = 'usersid=:usersid AND tourroutes_id=:tourroutes_id';
		$criteria_tourroutes->params = array(':usersid'=>$sched->user_ob->id,'tourroutes_id'=>$tour->id_tour_categories);
		$tourroutes = SegGuidesTourroutes::model()->find($criteria_tourroutes);
		$vat= Yii::app()->db->createCommand("SELECT value from mainoptions where name='Vat'")->queryScalar();
		$firma= Yii::app()->db->createCommand("SELECT value from mainoptions where name='Firma'")->queryScalar();
		$sum_itog=0;
		$sum_bar=0;
		$count_cust=0;
		
			foreach ($sched->guidestourinvoices as $invoice) {
				$model=$invoice->guidestourinvoicescustomers;
				$overAllIncome=0;
				$cashIncome=0;
				$count_inv=0;
				$invoice_id =  $invoice->idseg_guidesTourInvoices;
				for($k=0;$k<count($model);$k++){
					$kk=$model[$k]->idseg_guidesTourInvoicesCustomers;
					$count_cust++;
					$count_inv++;
					$model[$k]->tourInvoiceid = $invoice_id;
					if(!empty($_POST))
					{
						$model[$k]->customersName = $_POST['customersName'.$kk];
						$model[$k]->discounttype_id = $_POST['discounttype_id'.$kk];
						$model[$k]->paymentoptionid = $_POST['payoption'.$kk];
						$model[$k]->id_invoiceoptions = $_POST['option'.$kk];
						if(!empty($_POST['price'.$kk])) {
							$model[$k]->price = $_POST['price'.$kk];
						}
					}
					$overAllIncome+=is_null($model[$k]->price)? 0 : $model[$k]->price;
					if($model[$k]->paymentoptionid==1) $cashIncome+=is_null($model[$k]->price)? 0 : $model[$k]->price;
					if($model[$k]->paymentoptionid) $model[$k]->isPaid = 1;
					$model[$k]->save();
				}
				$invoice->creationDate = $sched->date;
				$invoice->cityid = $sched->city_id;
				$invoice->sched_tourid = $sched->tourroute_id;
				$invoice->guideNr = $sched->guide1_id;
				$invoice->status = 1;
				$invoice->id_sched = $sched->idseg_scheduled_tours;
				$invoice->overAllIncome = $overAllIncome;
				$invoice->cashIncome =  $cashIncome;
			 	$sum_itog += $invoice->overAllIncome;
				$sum_bar += $invoice->cashIncome;
//			 	$sum_itog += number_format($invoice->overAllIncome, 2, '.', ' ');
//				$sum_bar += number_format($invoice->cashIncome, 2, '.', ' ');
				$b = $tour->city['seg_cityname']{0};
				$year = date('y',time());
				$max= Yii::app()->db->createCommand("SELECT max(InvoiceNumber) from seg_guidestourinvoices where cityid=".$tour->cityid)->queryScalar();
				$max_i = $max+1;
				$invoice->TA_string = 'TA'.$b.$year.'/'.$max_i;
				$invoice->InvoiceNumber =$max_i;
				$invoice->save();
				$this->doPDF($sched, $invoice);
			}
		$sum_vat = round($sum_itog*(1-1/($vat/100+1)),2);
		$sum_b_vat = $sum_itog - $sum_vat;
	
		$cifra = $count_cust - $tourroutes->guest_variable;
		if($cifra<=0){$cifra=0;}//turists >
		$gonorar = $tourroutes->base_provision+$cifra*$tourroutes->guestsMinforVariable;//summa gonorar
		$gonorar_vat = $gonorar*(1-1/($vat/100+1));
		$gonorar_vat = number_format($gonorar_vat, 2, '.', ' ');
		
		
	
		
		//********************************SAVE INFO FOR PDF************************************************//
		$id_guide = $sched->guide1_id;
		
		$criteria_cash = new CDbCriteria;
		$criteria_cash->order ='timestamp DESC';
		$criteria_cash->condition = 'users_id=:users_id ';
		$criteria_cash->params = array(':users_id'=>$id_guide);
		$cashbox = CashboxHistory::model()->find($criteria_cash);
		
		if(!empty($cashbox)){
			$old_cash = $cashbox->cashBefore;
			$old_delta = $cashbox->delta_cash;
		}else{
			$old_cash = 0;
			$old_delta = 0;
		}
		$cashnew = new CashboxHistory;
		$cashnew->users_id = $id_guide;
		$cashnew->delta_cash = $sum_bar;
		$datetime = date('Y-m-d H:i:s', time());
		$cashnew->timestamp =$datetime;
		$cashnew->cashBefore = $old_cash+$old_delta;
		$cashnew->id_type = 1;
		$cashnew->id_sched = $sched->idseg_scheduled_tours;
		$cashnew->save();
		$cashnew1 = new CashboxHistory;
		$cashnew1->users_id = $id_guide;
		$cashnew1->delta_cash = -$gonorar;
		//$datetime = date('Y-m-d H:i:s', time());
		$cashnew1->timestamp =$datetime;
		$cashnew1->id_sched = $sched->idseg_scheduled_tours;
		$cashnew1->cashBefore = $cashnew->cashBefore+$cashnew->delta_cash;
		$cashnew1->id_type = 2;
		$cashnew1->save();
		
		$cashnow = $cashnew->cashBefore+$cashnew->delta_cash;

		//************************************PDF CREATE***************************************************//
		//$pdf->SetFont('freeserif', '', 14);
		$printOrders = null;
		$forpdf=array();
		$forpdf['gonorar_vat']=$gonorar_vat;
		$forpdf['firma']=$firma;
		$forpdf['cifra']=$cifra;
		$forpdf['base_provision'] = number_format($tourroutes->base_provision, 2, '.', ' ');
		$forpdf['guestsMinforVariable'] = number_format($tourroutes->guestsMinforVariable, 2, '.', ' ');
		$forpdf['gonorar_zero'] = number_format($gonorar, 2, '.', ' ');
		$forpdf['cashBefore'] = number_format($cashnew->cashBefore, 2, '.', ' '); 
		$forpdf['sum_bar_zero'] = number_format($sum_bar, 2, '.', ' '); 
		$forpdf['cashnow_zero'] = number_format($cashnow, 2, '.', ' '); 
		$forpdf['delta_cash_zero'] = number_format($cashnew->delta_cash, 2, '.', ' ');
		$forpdf['cashnow_enter'] = $forpdf['cashnow_zero']- $forpdf['gonorar_zero'];
		$this->doPDF($sched, $forpdf);
		$name_pdf2="tmpo";
		$sched->additional_info2=$name_pdf2;
		$sched->save();
				
		$this->redirect(array("current","id_sched"=>$id_sched));
		return;
				foreach ($mails as $value) {
					$this->sendMail($value, $files_name2);
			}
	          $this->redirect( Yii::app()->createUrl('/filespdf/'.$name_pdf2.'.pdf') );

/*			$this->render('testpdf',array(
					'tour'=>$tour,
					'invoicecustomers'=>$invoicecustomers,
					'sched'=>$sched,
					
					'vat'=>$vat,
					'invoice'=>$invoice,
					'sum_vat'=>$sum_vat,
					'sum_b_vat'=>$sum_b_vat,
					));*/
		//}

	}
	protected function doPDF($sched,$invoice)
	{
		$date_format = strtotime($sched->date);
		$date_format = date('d.m.Y',$date_format);
		$time_format = substr_replace($sched->starttime, 0, 4);
		$is_full=false;
		$forpdf=array();
		if(is_array($invoice)){
			$is_full=true;
			$forpdf=$invoice;
		}
		$tbl0 = '<table style="margin:30px;">
				<tr>
					<td>
						<div style="color:#000000;font-size:20px;font-weight:bold;">Route Accounting<br></div> 
						<table style="width:200px;">
							<tr>
								<td>Invoice number:</td>
								<td style="text-align:right;">'.$invoice->TA_string.'</td>
							</tr>
							<tr>
								<td>Date of invoice:</td>
								<td style="text-align:right;">'.$date_format.'</td>
							</tr>
							<tr>
								<td>Time of day:</td>
								<td style="text-align:right;">'.$time_format.'</td>
							</tr>
							<tr>
								<td>Tour ID:</td>
								<td style="text-align:right;">'.$sched->tourroute_id.'</td>
							</tr>
							<tr>
								<td>Page:</td>
								<td style="text-align:center;">1 of 2</td>
							</tr>
						</table> <br>
						<div style="color:#000000;font-size:15px;">Tour guests on '.$date_format.', '.$time_format.'</div>   
					</td>
					<td style="text-align:right;">';
					$tbl_img = '<img src="'.Yii::app()->request->baseUrl.'/img/str2/logo2.png" width="100px">';
					$tbl01='</td></tr></table><hr style="border:1px solid #000000;">';
					$tbl_array=array();
				
				$tbl02= '<table style="margin:30px;">
				  <tbody>
					<tr>
					  <th style="font-weight:bold;"><br>&nbsp;<br>TourHostNr<br></th>
					  <th style="font-weight:bold;"><br>&nbsp;<br>Name<br></th>
					  <th style="font-weight:bold;width:100px;"><br>&nbsp;<br>Discount<br></th>
					  <th style="font-weight:bold;"><br>&nbsp;<br>Payment<br></th>
					  <th style="font-weight:bold;width:50px;"><br>&nbsp;<br>Price<br></th>
					  <th style="font-weight:bold;width:50px;"><br>&nbsp;<br>Vat.<br></th>
					  <th style="font-weight:bold;width:100px;text-align:center;"><br>&nbsp;<br>Option<br></th>
					</tr>';
					$i=0;
					$sum_itog=0;
					$sum_bar=0;
					$count_cust=0;
				if($is_full)
					{
						foreach ($sched->guidestourinvoices as $invo) {
							$invoicecustomers=$invo->guidestourinvoicescustomers;
							$invoice_id =  $invo->idseg_guidesTourInvoices;
							$sum_itog += $invo->overAllIncome;
							$sum_bar += $invo->cashIncome;
						$name_pdf1 = $invo->TA_string;
						if(!empty($invoicecustomers)) { 
								 foreach($invoicecustomers as $item) { 
									$tbls='<tr><td>'.$item->KA_string.'</td><td>'.$item->customersName.'</td><td>';
									if($item->discounttype_id==0) {
										  $tbls.= '--';
									} else {
										  if($item->discount['val']==0){$tbls.= $item->discount['name'];}else{
											  $tbls.= $item->discount['val'].' '.$item->discount['type'];
										  }
									}
									$tbls.= '</td><td>'; 
									if (($item->paymentoptionid==0)or($item->discounttype_id==42)) {
										$tbls.='--';
										$work_price = '--';
										$work_vat = '--';
									 } else {
										$tbls.= $item->payment['displayname'];
										$work_price =  $item->price;
										$work_price = number_format($work_price, 2, '.', ' ');
										$work_price = $work_price.'&euro;';
										
										$tr = $item->price*(1-1/($vat/100+1));
										$work_vat =  $tr;
										$work_vat = number_format($work_vat, 2, '.', ' ');
										$work_vat = $work_vat.'&euro;';
									}
									if($item->discounttype_id==42) {$option_pdf = $item->invoiceoptions['name'];}else{$option_pdf =null;}
									$tbls.='</td><td>'.$work_price.'</td><td>'.$work_vat.'</td>';
									$tbls.='<td style="font-size:8px;text-align:center;">'.$option_pdf.'</td></tr>';
									$tbl_array[$i] = $tbls;
									$i++;
								}
							}
					
						}
					}
					else
					{
						$invoicecustomers=$invoice->guidestourinvoicescustomers;
						$invoice_id =  $invoice->idseg_guidesTourInvoices;
						$sum_itog += $invoice->overAllIncome;
						$sum_bar += $invoice->cashIncome;
						$name_pdf1 = $invoice->TA_string;
						if(!empty($invoicecustomers)) { 
								 foreach($invoicecustomers as $item) { 
									$tbls='<tr><td>'.$item->KA_string.'</td><td>'.$item->customersName.'</td><td>';
									if($item->discounttype_id==0) {
										  $tbls.= '--';
									} else {
										  if($item->discount['val']==0){$tbls.= $item->discount['name'];}else{
											  $tbls.= $item->discount['val'].' '.$item->discount['type'];
										  }
									}
									$tbls.= '</td><td>'; 
									if (($item->paymentoptionid==0)or($item->discounttype_id==42)) {
										$tbls.='--';
										$work_price = '--';
										$work_vat = '--';
									 } else {
										$tbls.= $item->payment['displayname'];
										$work_price =  $item->price;
										$work_price = number_format($work_price, 2, '.', ' ');
										$work_price = $work_price.'&euro;';
										
										$tr = $item->price*(1-1/($vat/100+1));
										$work_vat =  $tr;
										$work_vat = number_format($work_vat, 2, '.', ' ');
										$work_vat = $work_vat.'&euro;';
									}
									if($item->discounttype_id==42) {$option_pdf = $item->invoiceoptions['name'];}else{$option_pdf =null;}
									$tbls.='</td><td>'.$work_price.'</td><td>'.$work_vat.'</td>';
									$tbls.='<td style="font-size:8px;text-align:center;">'.$option_pdf.'</td></tr>';
									$tbl_array[$i] = $tbls;
									$i++;
								}
							}
					}
					$vat= Yii::app()->db->createCommand("SELECT value from mainoptions where name='Vat'")->queryScalar();
					$sum_vat = round($sum_itog*(1-1/($vat/100+1)),2);
					$sum_b_vat = $sum_itog - $sum_vat;

				  $tbl9='</tbody>
				</table>
				<br>
				<hr style="border:1px solid #000000;">
				<br>&nbsp;<br>
				<table  stytle="border:0px solid red;">
					<tr>
						<td width="45%">&nbsp;</td>
						<td width="30%" style="text-align:left;">Total revenue excluding VAT:</td>
						<td width="10%" style="text-align:right;">'.number_format($sum_b_vat, 2, '.', ' ').' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;">Sales tax: </td>
						<td style="text-align:right;">'.number_format($sum_vat, 2, '.', ' ').' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;">Total revenue: </td>
						<td style="text-align:right;">'.number_format($sum_itog, 2, '.', ' ').' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;font-weight:bold;">Share of cash income includes tax: </td>
						<td style="text-align:right;font-weight:bold;">'.number_format($sum_bar, 2, '.', ' ').' &euro;</td>
					</tr>
				</table>
				';
				$tbli='';
				for($j=0;$j<count($tbl_array);$j++){
					$tbli.=$tbl_array[$j];
				}
				$tbl = $tbl0.' '.$tbl_img.' '.$tbl01.' '.$tbl02.' '.$tbli.' '.$tbl9;
		
				
				$date_format_n = strtotime($sched->date);
				$date_format_n = date('Y-m-d',$date_format_n);
				$datename = $date_format_n;
				
				$name_pdf2 = $name_pdf1.'_'.$datename;
				if($is_full){$name_pdf2=$name_pdf2."_i";}
				$files_name1 = __DIR__.'/../../filespdf/'.str_replace("/", "-", $name_pdf2).'.pdf';
				$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor("Cheery Tours");
				$pdf->SetTitle("Tourabrechnung");
				$pdf->SetSubject("Tourabrechnung");
				$pdf->SetKeywords("Tourabrechnung");
				$pdf->setPrintHeader(false);
				$pdf->setPrintFooter(false);
				$pdf->AddPage();
				$pdf->SetFont('freeserif', '', 10);
				$pdf->writeHTML($tbl, true, false, false, false, '');
				if($is_full){
				$tbl_page2='
				<div style="color:#000000;font-size:20px;font-weight:bold;">Tour Guide</div>
				<br>
				<hr style="border:1px solid #000000;">
				<br>&nbsp;<br>
				<table width="100%" cellpadding="0" cellspacing="3" >
					  <tbody>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['street'].' '.$sched->user_ob->contact_ob['house'].'</td>
						  <td>&nbsp;</td>
						  <td colspan="2" style="font-size:12x;font-weight:bold;">Honorarium&nbsp;accounting:</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['postalcode'].' '.$sched->user_ob->contact_ob['city'].'</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>'.$sched->user_ob->contact_ob['country'].'</td>
						  <td>&nbsp;</td>
						  <td>Base honorarium:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['base_provision'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Tax number</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->guide_ob['taxnumber'].'</td>
						  <td>Guest Number Variable</td>
						  <td style="text-align:center;">'.$forpdf['cifra'].'x</td>
						  <td style="text-align:right;">'.$forpdf['guestsMinforVariable'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Tax office</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->guide_ob['taxoffice'].'</td>
						  <td style="font-weight:bold;">Total fees</td>
						  <td>&nbsp;</td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['gonorar_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Guide`s Invoice</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->GN_string.'</td>
						  <td colspan="2">(including '.$vat.'% vat:&nbsp;'.$forpdf['gonorar_vat'].'&nbsp;&euro;)</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>The fee in the amount of</td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['gonorar_zero'].'&nbsp;&euro;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>Was obtained from</td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['firma'].'</td>
						  <td style="font-size:12x;font-weight:bold;">Cash:</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>In cash to</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>paid</td>
						  <td>&nbsp;</td>
						  <td>Cash old:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['cashBefore'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td colspan="2" style="font-weight:bold;">I confirm the new cash bar consisted of</td>
						  <td>Cash receipts</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['sum_bar_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td colspan="2" style="font-weight:bold;">von&nbsp;'.$forpdf['cashnow_enter'].'&nbsp;&euro;</td>
						  <td>Total fees</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['gonorar_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td style="font-weight:bold;">Cash sanderung</td>
						  <td>&nbsp;</td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['delta_cash_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2">Cash new: am '.$date_format.';'.$time_format.'</td>
						  <td style="text-align:right;">'.$forpdf['cashnow_enter'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="3"><hr></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="3">Signature&nbsp;'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						</tr>
					  </tbody>
				</table>
			';
				$pdf->AddPage();
				$pdf->writeHTML($tbl_page2, true, false, false, false, '');

				}				
				$pdf->Output($files_name1, 'F');	

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SegBookings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegBookings']))
			$model->attributes=$_GET['SegBookings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SegBookings the loaded model
	 * @throws CHttpException
	 */
	public function loadHistory($id)
	{
		$model=CashboxHistory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadST($id)
	{
		$model=SegScheduledTours::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadContact($id)
	{
		$model=SegContacts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadUser($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadGuide()
	{
  		$gdata = SegGuidesdata::model()->findByPk(Yii::app()->user->gid);
		$gcontact= SegContacts::model()->findByPk(Yii::app()->user->cid);	
		if(($gdata===null)||($gcontact===null))
			throw new CHttpException(404,'The requested user data is missing.');
		return array('data'=>$gdata,'contact'=>$gcontact);
	}
	public function loadTours()
	{
        $id = Yii::app()->user->id;
		$model=SegScheduledTours::model()->findAll('guide1_id = :guide AND date_now>=:date',array(':guide'=>$id,':date'=>strtotime("midnight", time())));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadUnreported()
	{
        $id = Yii::app()->user->id;
		$model=SegScheduledTours::model()->findAll('guide1_id = :guide AND date_now<:date AND openTour IS NULL AND language_id IS NOT NULL',array(':guide'=>$id,':date'=>time()));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param SegBookings $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seg-bookings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
