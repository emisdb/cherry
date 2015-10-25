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
				'actions'=>array('view','profile','update','contact','user','weeks','take','show','ajaxShow','ajaxHistory','schedule','history','current','deleteST','delete'),
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
			'model'=>$this->loadModel($id),
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
	public function actionWeeks($date)
	{
	    $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
      //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
 
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
				));
	}

	public function actionTake($date,$time)
	{
	    $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $user_control = User::model()->findByPk($id_control);  
        $role_control = $user_control->id_usergroups;    
        // $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
			$arrtime=explode($time);
			$ortime=$arrtime[0].":00:00";
         
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
	public function actionCurrent($id_sched=null,$date=null,$time=null)
	{
	
		$id_control = Yii::app()->user->id;
        $guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
        // $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;

  			$date_format = strtotime($date);
			$date_bd = date('Y-m-d',$date_format);
			$dt =$date_bd.' '.$time;

			$criteria_booking = new CDbCriteria;
			$criteria_booking->condition = 'sched_tourid=:sched_tourid ';
			$criteria_booking->params = array(':sched_tourid'=>$id_sched);
			
			$booking = SegBookings::model()->findAll($criteria_booking);
				
			$criteria_sched = new CDbCriteria;
			$criteria_sched->condition = 'idseg_scheduled_tours=:idseg_scheduled_tours ';
			$criteria_sched->params = array(':idseg_scheduled_tours'=>$id_sched);
			$sched = SegScheduledTours::model()->find($criteria_sched);
				
			$book_z1 = array();$j=0;
			foreach($booking as $book){
				$book_z1[$j] = $book->idseg_bookings;	
				$j++;
			}
			$x=1;$xx=0;$cond='';$y=1;$yy=0;$param=array();
				foreach($booking as $book){
					if($xx==0){
						$xx=1;
					} else {
						$cond.=' OR ';
					}	
					if(($xx!=1)AND($x!=count($booking))) {
						$cond.=' OR ';
					}
					$cond.='origin_booking =:origin_booking'.$x;
					
					
					//param
					$param['origin_booking'.$y] = $book->idseg_bookings;
				
					$yy++;	$x++; $y++;
				}
				$criteria_invoicecustomer = new CDbCriteria;
				$criteria_invoicecustomer->condition = $cond;
				$criteria_invoicecustomer->params = $param;
				$model = SegGuidestourinvoicescustomers::model()->findAll($criteria_invoicecustomer);

				
				if(!empty($_POST))
				{
					$newcustomer=$_POST['new_customer'];
					if($newcustomer>0)
					{
						if(count($model)>0)
						{
							$customer = new SegGuidestourinvoicescustomers;
//							$customer->setAttributes($model[0]->attributes, true);
							$customer->customersName = $model[0]->customersName;
							$customer->price = $model[0]->price;
							$customer->cityid = $model[0]->cityid;					
							$customer->tourInvoiceid =  $model[0]->tourInvoiceid ;
							$max= Yii::app()->db->createCommand("SELECT max(CustomerInvoiceNumber) from seg_guidestourinvoicescustomers where cityid=".$customer->cityid)->queryScalar();
							$max_i = $max+1;
							$splitstr=  explode("/",$model[0]->KA_string);
							$customer->KA_string = $splitstr[0]."/".$max_i;
							$customer->CustomerInvoiceNumber = $max_i;
							$customer->isPaid = 0;
							$customer->origin_booking = $model[0]->origin_booking ;
							$customer->save();
							$model = SegGuidestourinvoicescustomers::model()->findAll($criteria_invoicecustomer);
							
						}
					}
					else
					{
					//create guidetourinvoice
					//проверка на существование invoice
					$criteria_prov = new CDbCriteria;
					$criteria_prov->condition = 'guideNr=:guideNr AND id_sched=:id_sched ';
					$criteria_prov->params = array(':guideNr'=>$sched->guide1_id,':id_sched'=>$sched->idseg_scheduled_tours);
					$prov = SegGuidestourinvoices::model()->find($criteria_prov);
					
					if(!empty($prov)){
						$invoice = $prov;
						
					} else {
						$invoice = new SegGuidestourinvoices;
					}

					$invoice->creationDate = $sched->date;
					$invoice->cityid = $sched->city_id;
					$invoice->sched_tourid = $sched->tourroute_id;
					$invoice->guideNr = $sched->guide1_id;
					$invoice->status = 0;
					$invoice->id_sched = $sched->idseg_scheduled_tours;
					$invoice->overAllIncome = $_POST['price_s_post'];
					$invoice->cashIncome =  $_POST['price_cash_post'];
					
					
					$invoice->save();
					$invoice_id =  $invoice->idseg_guidesTourInvoices;
								
					//foreach($model as $item){
					for($k=0;$k<count($model);$k++){
						$model[$k]->tourInvoiceid = $invoice_id;
						$model[$k]->customersName = $_POST['customersName'.$k];
						$model[$k]->discounttype_id = $_POST['discounttype_id'.$k];
						$model[$k]->paymentoptionid = $_POST['payoption'.$k];
						if(!empty($_POST['price'.$k])) $model[$k]->price = $_POST['price'.$k];
						$model[$k]->id_invoiceoptions = $_POST['option'.$k];
						if($model[$k]->paymentoptionid)$model[$k]->isPaid = 1;
					
						$model[$k]->save();
						
					}
				}
				}
	
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

				
				$test=array('guide'=>$this->loadGuide(),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 				
				$this->render('current',array(
					'model'=>$model,
					'guide'=>$guide,
					'sched'=>$sched,
					'id_sched'=>$id_sched,
					'date'=>$date,
					'time'=>$time,
					'vat_nds'=>$vat_nds,
					'pay'=>$pay,
					'dis'=>$dis,
					'invoiceoptions_array'=>$invoiceoptions_array,
					'info'=>$test,
				));
	
	
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
