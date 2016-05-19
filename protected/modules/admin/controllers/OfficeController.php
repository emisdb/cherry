<?php
class OfficeController extends Controller
{
	public $layout='/layouts/office_bs';
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	public $cashsum=0;
	public $totval=0;
        
        public function init() {
                parent::init();
  		$command=Yii::app()->db->createCommand();
            $command->select('SUM(delta_cash) AS sum');
        $command->from('cashbox_change_requests');
        $command->where('approvedBy IS NOT NULL');

//                $command->where('id_users=:id', array(':id'=>Yii::app()->user->id));
        $this->cashsum= $command->queryScalar();
        }


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow', // allow authenticated users to access all actions
//				'users'=>array('@'),
                'roles'=>array('office'),                
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	protected function adding($data,$row){
		$this->totval=$this->totval+$data->delta_cash;
		return Yii::app()->numberFormatter->formatCurrency($this->totval, '') ;
	}
		public function actionCashRecord($id)
	{
			$id_control = Yii::app()->user->id;
			$model=$this->loadCash($id);
			$model->from_date = Mainoptions::model()->getCvalue('payf_'.$id_control);
			$model->to_date = Mainoptions::model()->getCvalue('payt_'.$id_control);
			if($model->request_date<$model->from_date)
			{
				Mainoptions::model()->setCvalue('payf_'.$id_control,date("Y-m-d",strtotime($model->request_date)));
			}
			elseif ($model->request_date>$model->to_date) {
				Mainoptions::model()->setCvalue('payt_'.$id_control,date("Y-m-d",strtotime($model->request_date)));
			}
            $this->redirect(array('cashReport','id'=>$model->id_users,'typo'=>1));
			
		
	}
		public function actionCashReport($id,$typo=0)
	{
		$id_control = Yii::app()->user->id;
		$model=new CashboxChangeRequests();
		$model->unsetAttributes();  // clear any default values
		$model->id_users=$id;
		$user=User::model()->with('contact_ob')->find('id=:id',array(':id'=>$id));
		 if(empty($_POST))
		 {
			$model->from_date = Mainoptions::model()->getCvalue('payf_'.$id_control);
			$model->to_date = Mainoptions::model()->getCvalue('payt_'.$id_control);

		 }
		 else
		  {
            Mainoptions::model()->setCvalue('payf_'.$id_control,$_POST['CashboxChangeRequests']['from_date']);
			Mainoptions::model()->setCvalue('payt_'.$id_control,$_POST['CashboxChangeRequests']['to_date']);
			$model->from_date = $_POST['CashboxChangeRequests']['from_date'];
			$model->to_date = $_POST['CashboxChangeRequests']['to_date'];
		}
		$cashnow=0;
		if(isset($model->from_date)) 
		{
			
		$command=Yii::app()->db->createCommand();
        $command->select('SUM(delta_cash) AS sum');
        $command->from('cashbox_change_requests');
        $command->where('id_users=:id AND request_date < :rd', array(':id'=>$id,':rd'=>date('Y-m-d H:i:s', strtotime($model->from_date))));
        $cashnow= $command->queryScalar();
		$this->totval=$cashnow;

		}

 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		if($typo==0) $view='cash_admin';
		else  $view='cash_admin_1';
	$this->render($view,array(
				'model'=>$model,
				'user'=>$user,
				'cashnow'=>$cashnow,
				'info'=>$test
		));
	}
	public function actionCashAdmin()
	{
		$id_control = Yii::app()->user->id;
		$model=new CashboxChangeRequests('search_full');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CashboxChangeRequests']))
			$model->attributes=$_GET['CashboxChangeRequests'];
		 if(empty($_POST))
		 {
			$model->from_date = Mainoptions::model()->getCvalue('payf_'.$id_control);
			$model->to_date = Mainoptions::model()->getCvalue('payt_'.$id_control);

		 }
		 else
		  {
            Mainoptions::model()->setCvalue('payf_'.$id_control,$_POST['CashboxChangeRequests']['from_date']);
			Mainoptions::model()->setCvalue('payt_'.$id_control,$_POST['CashboxChangeRequests']['to_date']);
			$model->from_date = $_POST['CashboxChangeRequests']['from_date'];
			$model->to_date = $_POST['CashboxChangeRequests']['to_date'];
		}
		$cashnow=0;
		if(isset($model->from_date)) 
		{
			
		$command=Yii::app()->db->createCommand();
        $command->select('SUM(delta_cash) AS sum');
        $command->from('cashbox_change_requests');
        $command->where('request_date < :rd', array(':rd'=>date('Y-m-d H:i:s', strtotime($model->from_date))));
        $cashnow= $command->queryScalar();
		$this->totval=$cashnow;

		}
	$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		$this->render('admin_cash',array(
			'model'=>$model,
			'cashnow'=>$cashnow,
			'info'=>$test
	));
	}

		public function actionCashFull()
	{
		$id_control = Yii::app()->user->id;
		$model=new CashboxChangeRequests();
		$model->unsetAttributes();  // clear any default values
    	if(isset($_POST['CashboxChangeRequests']))
			$model->attributes=$_POST['CashboxChangeRequests'];
		 if(empty($_POST))
		 {
			$model->from_date = Mainoptions::model()->getCvalue('payf_'.$id_control);
			$model->to_date = Mainoptions::model()->getCvalue('payt_'.$id_control);

		 }
		 else
		  {
            Mainoptions::model()->setCvalue('payf_'.$id_control,$_POST['CashboxChangeRequests']['from_date']);
			Mainoptions::model()->setCvalue('payt_'.$id_control,$_POST['CashboxChangeRequests']['to_date']);
			$model->from_date = $_POST['CashboxChangeRequests']['from_date'];
			$model->to_date = $_POST['CashboxChangeRequests']['to_date'];
		}
		$cashnow=0;
		if(isset($model->from_date)) 
		{
			
		$command=Yii::app()->db->createCommand();
        $command->select('SUM(delta_cash) AS sum');
        $command->from('cashbox_change_requests');
        $command->where('request_date < :rd', array(':rd'=>date('Y-m-d H:i:s', strtotime($model->from_date))));
        $cashnow= $command->queryScalar();
		$this->totval=$cashnow;

		}

 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		$view='cash_full';
	$this->render($view,array(
				'model'=>$model,
				'cashnow'=>$cashnow,
				'info'=>$test
		));
	}


	public function actionCreate()
	{
	   $id_control = Yii::app()->user->id;
         
		$model=new Bonus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bonus']))
		{
			$model->attributes=$_POST['Bonus'];
			if($model->save())
				$this->redirect(array('bonus'));
		}

	$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  	$this->render('create',array(
			'model'=>$model,
				'info'=>$test,
	));
	}
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['Bonus']))
		{
			$model->attributes=$_POST['Bonus'];
			if($model->save())
				$this->redirect(array('bonus'));
		}
	 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
		$this->render('update',array(
			'model'=>$model,
				'info'=>$test,
	));
	}
	public function actionUserCreate()
	{
            $model=new User;
            $model_contact = new SegContacts;
            $model_guide = new SegGuidesdata;
			$criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
            $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
            $usergroups = Usergroups::model()->findAll($criteria);

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

            if(isset($_POST['User']))
            {
		    //information profile
                $model->id_usergroups = $_POST['User']['id_usergroups'];
                            $model->attributes=$_POST['User'];
                            $model_contact->attributes=$_POST['SegContacts'];
                $model->status =1;  
				if($model->validate())
				{
                if($model_contact->save()){
//  var_dump($model->attributes);
                    $model->id_contact =  $model_contact->idcontacts;
                    if($model->id_usergroups==5){
                        if($model_guide->save())
                            $model->id_guide =  $model_guide->idseg_guidesdata;
                    }
                 if($model->save())
                    $this->redirect(array('ucontact','id_user'=>$model->id));
                }
            }
			}
            $test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
            $this->render('create_user',array(
                    'model'=>$model,
                    'modelc'=>$model_contact,
                    'usergroups'=>$usergroups,
                    'info'=>$test,
            ));
	}
	public function actionUserUpdate($id)
	{
    		$model=$this->loadUser($id);
    
    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
    
    		if(isset($_POST['User']))
    		{
    			$model->attributes=$_POST['User'];
               // $model->id_usergroups = $_POST['User']['role_ob'];
    			if($model->save())
                            $this->redirect(array('admin'));
    		}
    
 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
    		$this->render('update_user',array(
    			'model'=>$model,//,'usergroups'=>$usergroups
			'info'=>$test,
		));
  	}
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('bonus'));
	}
	public function actionUserDelete($id)
	{
		$this->loadUser($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Comment', array(
			'criteria'=>array(
				'with'=>'post',
				'order'=>'t.status, t.create_time DESC',
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());


			$this->render('profile',array(
//			$this->render('user_1',array(
				'model'=>$model,
			'info'=>$test,
			));
    }

	public function actionUser($id)
	{
        $id_control = Yii::app()->user->id;
      	$model=$this->loadUser($id);
		$role_control = $model->id_usergroups; 

    
    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
  
    		if(isset($_POST['User']))
    		{
    			$model->attributes=$_POST['User'];
               // $model->id_usergroups = $_POST['User']['role_ob'];
    			if($model->save())
				{
    				    $this->redirect(array('profile'));
                    } 
    		}
 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
     
    		$this->render('user',array(
    			'model'=>$model,//,'usergroups'=>$usergroups
  			'info'=>$test,
  		));
        
	}
	public function actionContact($id)
	{
	    $id_control = Yii::app()->user->id;
        $update_user = User::model()->findByPk($id);
   		$model=$this->loadContact($id);
    
    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
    
    		if(isset($_POST['SegContacts']))
    		{
    			$model->attributes=$_POST['SegContacts'];
     			if($model->save())
				{
    				    $this->redirect(array('profile'));
                    }
    		}
  		$test=array('guide'=>$model,'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
    		$this->render('contact_',array(
    			'model'=>$model,
				'update_user'=>$update_user,
  			'info'=>$test,
				));
  }
	public function actionUcontact($id_user)
	{
	    $id_control = Yii::app()->user->id;
        $update_user = User::model()->findByPk($id_user);
        $result=false;   
        $id_contact = $update_user->id_contact;
        $id_guide = $update_user->id_guide;
			
    	$model=$this->loadContact($id_contact);
	$modelgd=$this->loadGuideData($id_guide);
 
        $criteria_t=new CDbCriteria;
        $criteria_t->condition='usersid=:usersid';
        $criteria_t->params=array(':usersid'=>$id_user);
        $link_tourroutes = SegGuidesTourroutes::model()->findAll($criteria_t);

        $array_tour = array();
        $array_tour_link = array();
        if(count($link_tourroutes)>0) {

                $criteria_a=new CDbCriteria;
                $criteria_a->condition='users_id=:users_id';
                $criteria_a->params=array(':users_id'=>$id_user);
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
        $criteria=new CDbCriteria;
        $criteria->condition='users_id=:users_id';
        $criteria->params=array(':users_id'=>$id_user);
        $selected_lang_list=CHtml::listData(SegLanguagesGuides::model()->findAll($criteria),'idseg_languages_guides','languages_id');
        $lang_list=CHtml::listData(Languages::model()->findAll(),'id_languages','germanname');
        
        $criteria=new CDbCriteria;
        $criteria->condition='usersid=:usersid';
        $criteria->params=array(':usersid'=>$id_user);
        $selected_cat_list=CHtml::listData(SegGuidesTourroutes::model()->findAll($criteria),'idseg_guides_tourroutes','tourroutes_id');
        $cat_list=CHtml::listData(TourCategories::model()->findAll(),'id_tour_categories','name');
 
        $criteria=new CDbCriteria;
        $criteria->condition='users_id=:usersid';
        $criteria->params=array(':usersid'=>$id_user);
        $city=$this->loadGuideCity($id_user);
 
     
    		if(isset($_POST['SegContacts']))
    		{
    			$model->attributes=$_POST['SegContacts'];
           		if($model->save()) $result=true;
                        else $result=false;
    		}
 		if($result)
                {
                   if(isset($_POST['SegGuidesdata']))
                    {
                          $lnk_to_picture_old = $modelgd->lnk_to_picture;
                         $lnk_to_license_old = $modelgd->lnk_to_license;
                      $modelgd->attributes=$_POST['SegGuidesdata'];
                             $modelgd->image = CUploadedFile::getInstance($modelgd,'image');
                                             if($modelgd->image!=""){
                                             if((($lnk_to_picture_old!="")||($lnk_to_picture_old!=NULL))&& file_exists('image/guide/'.$lnk_to_picture_old))
                                        unlink('image/guide/'.$lnk_to_picture_old);
                                    $name_uniqid = uniqid();
                                    $modelgd->lnk_to_picture = $name_uniqid;
                                    $file = 'image/guide/'.$modelgd->lnk_to_picture;
                                    $modelgd->image->saveAs($file);
                                }
                             $modelgd->doc = CUploadedFile::getInstance($modelgd,'doc');
                                  if($modelgd->doc!=""){
                                    if((($lnk_to_license_old!="")||($lnk_to_license_old!=NULL)) && file_exists('image/guide/'.$lnk_to_license_old))
                                        unlink('image/guide/'.$lnk_to_license_old);
                                    $ext=pathinfo($modelgd->doc, PATHINFO_EXTENSION);
                                      $name_uniqid = uniqid().".".$ext;
                                    $modelgd->lnk_to_license = $name_uniqid;
                                    $file = 'image/guide/'.$modelgd->lnk_to_license;
                                    $modelgd->doc->saveAs($file);
                                  
                                }


//                                $modelgd->guides_cashbox_account_DTV="1";
/* */                      if($modelgd->save()){  
                               $result=true;
                            }
                            else
                            {
                                $result=false;
                            }
                    }
                }
 		$j=0;
		if($result)
                {
                    if(isset($_POST['SegGuidesTourroutes'])) {
                            foreach($link_tourroutes as $item) {
                                    $item->base_provision = $_POST['SegGuidesTourroutes']['base_provision'.$j];
                                    $item->guest_variable = $_POST['SegGuidesTourroutes']['guest_variable'.$j];
                                    $item->guestsMinforVariable = $_POST['SegGuidesTourroutes']['guestsMinforVariable'.$j];
                                    $item->voucher_provision = $_POST['SegGuidesTourroutes']['voucher_provision'.$j];
                                    $item->save();
                                    $j++;
                            }
                    }
                }
		if($result)
                {
                     if(isset($_POST['SegGuidesCities'])) {
                        $city->attributes=$_POST['SegGuidesCities'];
			$city->users_id=$id_user;
           		if($city->save()) $result=true;
                        else $result=false;
                        
                     }
               
                }
 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 		if($result)	{
			   if(isset($_POST['SegGuidesOptions'])) {
				   $langs=$_POST['SegGuidesOptions']['langlist'];
				   $cats=$_POST['SegGuidesOptions']['catlist'];
				   foreach ($selected_lang_list as $key => $value){
					   if(!in_array($value, $langs)){
							$this->loadLang($key)->delete(); 
					   }

				   }
				   foreach ($langs as $value) {
					   if(!in_array($value, $selected_lang_list)){
							$model_lang = new SegLanguagesGuides;
							$model_lang->users_id = $id_user;
							$model_lang->languages_id = $value;
							$model_lang->save();
					   }

				   }
				   foreach ($selected_cat_list as $key => $value){
					   if(!in_array($value, $cats)){
							$this->loadGTR($key)->delete(); 
					   }

				   }
				   foreach ($cats as $value) {
					   if(!in_array($value, $selected_cat_list)){
							$model_lang = new SegGuidesTourroutes;
							$model_lang->usersid = $id_user;
							$model_lang->tourroutes_id = $value;
							$model_lang->save();
					   }

				   }
				 }

                }
                if ($result)
                {
 			$this->redirect(array('admin'));                 
                }
                else 
                {
                    $this->render('contact',array(
                    'model'=>$model,'modelgd'=>$modelgd,
                    'update_user'=>$update_user,
                    'link_tourroutes'=>$link_tourroutes,
 			'array_tour' => $array_tour,
			'array_tour_link' => $array_tour_link,
 			'selected_lang_list' => $selected_lang_list,
			'lang_list' => $lang_list,
			'selected_cat_list' => $selected_cat_list,
			'cat_list' => $cat_list,
 			'city' => $city,
                        'info'=>$test,
                                    ));

                }
  
         }
  	public function actionGuide($id,$id_user)
	{
	    $id_control = Yii::app()->user->id;
            $update_user = User::model()->findByPk($id_user);
   		$model=$this->loadGuideData($id);
		
		$criteria_user=new CDbCriteria;
		$criteria_user->condition='id_guide=:id_guide';
		$criteria_user->params=array(':id_guide'=>$model->idseg_guidesdata);
		$id_user = User::model()->find($criteria_user)->id;

		$criteria_guidestourroutes=new CDbCriteria;
                $criteria_guidestourroutes->condition='usersid=:usersid';
                $criteria_guidestourroutes->params=array(':usersid'=>$id_user);
  		$istourroutes = count(SegGuidesTourroutes::model()->findAll($criteria_guidestourroutes));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegGuidesdata']))
		{
			$model->attributes=$_POST['SegGuidesdata'];
                        $lnk_to_picture_old = $model->lnk_to_picture;
                        $model->image = CUploadedFile::getInstance($model,'image');
            
           // print_r( $_POST['SegGuidesdata']);
            // print_r( $model->image);
            
            if($model->image!=""){
                $name_uniqid = uniqid();
                //$lnk_to_picture_old = $model->lnk_to_picture;
                $model->lnk_to_picture = $name_uniqid;
            }
			if($model->save()){
                if($model->image!=""){
                    if(($lnk_to_picture_old!="")or($lnk_to_picture_old!=NULL))unlink('image/guide/'.$lnk_to_picture_old);
                    $file = 'image/guide/'.$model->lnk_to_picture;
                    $model->image->saveAs($file);
                }
				$this->redirect(array('userUpdate','id'=>$id_user));
            }
		}

	  		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

 	$this->render('update_gd',array(
			'model'=>$model,
			'id_user'=>$id_user,
			'update_user'=>$update_user,
			'istourroutes'=>$istourroutes,
	 		'info'=>$test,
	));
	}
  	public function actionDeleteST($id)
	{
		$this->loadST($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(array('schedule'));
	}
	public function actionBonus()
	{
	   $id_control = Yii::app()->user->id;
       // $update_user = User::model()->findByPk($id_user);
   		$model=new Bonus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bonus']))
			$model->attributes=$_GET['Bonus'];

	 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
	$this->render('bonus',array(
			'model'=>$model,
			'info'=>$test,
	));
	}
	public function actionCr()
	{
		$model=new CancellationReason('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CancellationReason']))
			$model->attributes=$_GET['CancellationReason'];
	 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 
		$this->render('admin_cr',array(
			'model'=>$model,
				'info'=>$test,
	));
	}
	public function actionDr()
	{
		$model=new CancellationReason('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CancellationReason']))
			$model->attributes=$_GET['CancellationReason'];
	 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 
		$this->render('admin_cr',array(
			'model'=>$model,
				'info'=>$test,
	));
	}
	public function actionCreatecr()
	{
		$model=new CancellationReason;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CancellationReason']))
		{
			$model->attributes=$_POST['CancellationReason'];
			if($model->save())
				$this->redirect(array('cr'));
		}
	 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 
		$this->render('create_cr',array(
			'model'=>$model,
				'info'=>$test,
	));
	}
	public function actionUpdatecr($id)
	{
		$model=$this->loadCR($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CancellationReason']))
		{
			$model->attributes=$_POST['CancellationReason'];
			if($model->save())
					$this->redirect(array('cr'));
	}
	 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
 
		$this->render('update_cr',array(
			'model'=>$model,
				'info'=>$test,
	));
	}
	public function actionDeleteCR($id)
	{
		$this->loadCR($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('cr'));
	}
	public function actionCashApprove($id)
	{
		$id_control = Yii::app()->user->id;
		$guide=$this->loadContact(Yii::app()->user->cid);
		$model=$this->loadCash($id);
		$model->approvedBy=$id_control;
		$model->approval_date = date('Y-m-d H:i:s', time());
		if($model->save()){
			if($model->id_type==3)
			{
				$cash_model=new CashboxChangeRequests();
				$cash_model->approvedBy=$id_control;
				$cash_model->approval_date = date('Y-m-d H:i:s', time());
				$cash_model->id_type=3;
				$cash_model->id_users=$model->sched_user_id;
				$cash_model->delta_cash = -$model->delta_cash;
				$cash_model->sched_user_id = $model->id_users;
				$cash_model->save();
				if(strlen($model->user->contact_ob->email)>0){
					$this->sendMail($model->user->contact_ob->email,"CR approval for ".$model->idcashbox_change_requests,
						"Dear ".$model->user->contact_ob->firstname." ".$model->user->contact_ob->surname.
							". Your CR at ".$model->request_date." for  ".$model->reason.
							" in ammount ".$model->delta_cash." euro has been approved by ".
							$guide->firstname." ".$guide->surname.". Date ".$model->approval_date." .");
				}
			}
		}
		
		$this->redirect(array('cashReport','id'=>$model->id_users,'typo'=>1));
	}
	public function actionCashReject($id)
	{
		$id_control = Yii::app()->user->id;
		$guide=$this->loadContact(Yii::app()->user->cid);
		$model=$this->loadCash($id);
		$model->reject=true;
		$model->approval_date = date('Y-m-d H:i:s', time());
		if($model->save()){
				if(strlen($model->user->contact_ob->email)>0){
					$this->sendMail($model->user->contact_ob->email,"CR rejection for ".$model->idcashbox_change_requests,
						"Dear ".$model->user->contact_ob->firstname." ".$model->user->contact_ob->surname.
							". Your CR at ".$model->request_date." for  ".$model->reason.
							" in ammount ".$model->delta_cash."euro has been rejected by ".
							$guide->firstname." ".$guide->surname.". Date ".$model->approval_date." .");
				}
		}
		$this->redirect(array('cashReport','id'=>$model->id_users,'typo'=>1));
	}
	public function actionAdmin()
	{
		$cash_model=new CashboxChangeRequests;
		$id_control = Yii::app()->user->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CashboxChangeRequests']))
		{
			$cash_model->attributes=$_POST['CashboxChangeRequests'];
			$cash_model->approvedBy=$id_control;
			$cash_model->approval_date = date('Y-m-d H:i:s', time());
//			$cash_model->request_date = date('Y-m-d H:i:s', time());
			$cash_model->id_type=5;
//			var_dump($cash_model);return;
			if($cash_model->save()){
				$cash_model=new CashboxChangeRequests;
			}
		}

     		$model=new User('search_office');
            $criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
            $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
            $usergroups = Usergroups::model()->findAll($criteria);
           // $modelsearch = $model->search_office();
     	$role_control = $model->id_usergroups; 

        
		$model->unsetAttributes();  // clear any default values
    	if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
//    	if(isset($_POST['User']))
//			$model->attributes=$_POST['User'];
			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
			$this->render('user_admin',array(
			'model'=>$model,
			'cash_model'=>$cash_model,
			'role_control'=>$role_control,
			'usergroups'=>$usergroups,
			'info'=>$test,
		));
	}
   	public function actionBooking()
	{
   		$id_control = Yii::app()->user->id;
		$model=new SegGuidestourinvoices('search');
		$model->unsetAttributes();  // clear any default values
 
		if(empty($_POST))
		{
			$model->from_date = Mainoptions::model()->getCvalue('schf_'.$id_control);
			$model->to_date = Mainoptions::model()->getCvalue('scht_'.$id_control);

		}
	 else
		{
			Mainoptions::model()->setCvalue('schf_'.$id_control,$_POST['SegGuidestourinvoices']['from_date']);
			Mainoptions::model()->setCvalue('scht_'.$id_control,$_POST['SegGuidestourinvoices']['to_date']);
			$model->from_date = $_POST['SegGuidestourinvoices']['from_date'];
			$model->to_date = $_POST['SegGuidestourinvoices']['to_date'];
			$model->attributes=$_POST['SegGuidestourinvoices'];
 		}
    	if(isset($_GET['SegGuidestourinvoices']))
			$model->attributes=$_GET['SegGuidestourinvoices'];
    	$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
		$this->render('gtiadmin',array(
			'model'=>$model,
	 		'info'=>$test,
		));

	}

         	public function actionZitysched()
	{
            $model=new SegScheduledTours('search');
            $model->unsetAttributes();  // clear any default values
        	$id_control = Yii::app()->user->id;
        if(empty($_POST))
            {
                    $model->from_date = Mainoptions::model()->getCvalue('zi_'.$id_control);
  
            }
             else
            {

                    Mainoptions::model()->setCvalue('zi_'.$id_control,$_POST['SegScheduledTours']['from_date']);
                     $model->from_date = $_POST['SegScheduledTours']['from_date'];  
                     $model->attributes=$_POST['SegScheduledTours'];
            }  
                    $dt =date_create($model->from_date);
                    $interval=new DateInterval( "P6D" );
                    date_add($dt,$interval);
                    $model->to_date=  date("Y-m-d",date_timestamp_get($dt));	


//                      $model->to_date = DateTime::createFromFormat('Y-m-d',$model->from_date)
//                       ->add(DateInterval::createFromDateString('6 days'))
//                       ->format('Y-m-d');  
	$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
		$this->render('citysched',array(
			'model'=>$model,
			'info'=>$test,
		));
       }

   	public function actionSchedule()
	{
		$newrec=0;
		$id_control = Yii::app()->user->id;
        $model=new SegScheduledTours('search');
		$model->unsetAttributes();  // clear any default values
 
		if(empty($_POST))
		{
			$model->from_date = Mainoptions::model()->getCvalue('schf_'.$id_control);
			$model->to_date = Mainoptions::model()->getCvalue('scht_'.$id_control);

		}
		 else
		{
			if(isset($_POST['newrecord']))
			{
				$newrec=$_POST['newrecord'];

				if($newrec){
					$id=$_POST['new_city'];
							$this->redirect(array('schednew','id'=>$id));
					return;
				}
			}
			Mainoptions::model()->setCvalue('schf_'.$id_control,$_POST['SegScheduledTours']['from_date']);
			Mainoptions::model()->setCvalue('scht_'.$id_control,$_POST['SegScheduledTours']['to_date']);
			$model->from_date = $_POST['SegScheduledTours']['from_date'];
			$model->to_date = $_POST['SegScheduledTours']['to_date'];
			$model->attributes=$_POST['SegScheduledTours'];
 		}
    	if(isset($_GET['SegScheduledTours']))
			$model->attributes=$_GET['SegScheduledTours'];
    	$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
		$this->render('officeadmin',array(
			'model'=>$model,
			'id_control'=>$id_control,
 			'info'=>$test,
		));
	}
	protected function dosched($id)
	{
		$command= Yii::app()->db->createCommand("SELECT seg_tourroutes.idseg_tourroutes AS tid, seg_tourroutes.name AS tnam, seg_tourroutes.TNmax AS tmax, seg_tourroutes.standard_duration AS dur,
														seg_guides_tourroutes.usersid AS uid, CONCAT(seg_contacts.firstname,' ',seg_contacts.surname) AS unam,
														seg_languages_guides.languages_id AS lid, tbl_languages.englishname AS lnam
													FROM ((((((seg_tourroutes INNER JOIN seg_guides_tourroutes ON seg_tourroutes.id_tour_categories=seg_guides_tourroutes.tourroutes_id)
														INNER JOIN seg_guides_cities ON seg_guides_tourroutes.usersid=seg_guides_cities.users_id)
														INNER JOIN seg_languages_guides ON seg_guides_tourroutes.usersid=seg_languages_guides.users_id)
														INNER JOIN tbl_user ON seg_guides_tourroutes.usersid=tbl_user.id)
														INNER JOIN seg_contacts ON seg_contacts.idcontacts=tbl_user.id_contact)
														INNER JOIN tbl_languages ON seg_languages_guides.languages_id=tbl_languages.id_languages)
												WHERE seg_tourroutes.cityid=".$id." AND seg_guides_cities.cities_id=".$id);
		$dataReader=$command->queryAll();
	$routs=array();
    $languages=array();
    $guides=array();

		foreach($dataReader as $row) { 
			if(!array_key_exists ($row['tid'],$routs))
			{
				$routs[$row['tid']]=array($row['tid'],$row['tnam'],array($row['lid']),array($row['uid']),$row['tmax'],$row['dur']);
			}
			else{
				if(!in_array($row['lid'],$routs[$row['tid']][2]))
						$routs[$row['tid']][2][]=$row['lid'];
				if(!in_array($row['uid'],$routs[$row['tid']][3]))
						$routs[$row['tid']][3][]=$row['uid'];
			}
			if(!array_key_exists ($row['lid'],$languages))
			{
				$languages[$row['lid']]=array($row['lid'],$row['lnam'],array($row['tid']),array($row['uid']));
			}
			else{
				if(!in_array($row['tid'],$languages[$row['lid']][2]))
						$languages[$row['lid']][2][]=$row['tid'];
				if(!in_array($row['uid'],$languages[$row['lid']][3]))
						$languages[$row['lid']][3][]=$row['uid'];
			}
			if(!array_key_exists ($row['uid'],$guides))
			{
				$guides[$row['uid']]=array($row['uid'],$row['unam'],array($row['tid']),array($row['lid']));
			}
			else{
				if(!in_array($row['tid'],$guides[$row['uid']][2]))
						$guides[$row['uid']][2][]=$row['tid'];
				if(!in_array($row['lid'],$guides[$row['uid']][3]))
						$guides[$row['uid']][3][]=$row['lid'];
			}
		}
		return array($routs,$languages,$guides);
 	}
	public function actionSchednew($id)
	{
		$id_control = Yii::app()->user->id;
		$model= new SegScheduledTours();
 		$model->city_id=$id;
        $date_bd = date('Y-m-d');
        $date_format =  strtotime($date_bd);
		$model->starttime = date("H").":00";
    	$model->date = $date_bd;
        $model->visibility = 1;
	    $model->isCanceled = 0;
        	if(isset($_POST['SegScheduledTours']))
		{
			$model->attributes=$_POST['SegScheduledTours'];
	        $model->date_now = strtotime($model->date);
            $model->original_starttime = explode(":",$model->starttime)[0].":00";
	 		if($model->save())
					$this->redirect(array('schedule'));
		}


			$arrays=$this->dosched($id);

                $test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
                $this->render('sched',array(
                'model'=>$model,
                'arrays'=>$arrays,
               'info'=>$test,
        	));
	}
	
	public function actionSched($id)
	{
		$id_control = Yii::app()->user->id;
		$model=$this->loadST($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        	if(isset($_POST['SegScheduledTours']))
		{
                    $changed=0;
                    $o_date=$model->date;
                    $o_time=$model->starttime;
                    $o_guide=$model->guide1_id;
                $model->attributes=$_POST['SegScheduledTours'];
                    if($o_date <> $model->date) $changed=$changed+1;
                    if(strtotime($o_time) <> strtotime($model->starttime)) $changed=$changed+2;
                    if($o_guide <> $model->guide1_id) $changed=$changed+4;
                     $original_starttime = explode(":",$model->starttime)[0].":00";
                    $model->original_starttime = $original_starttime;
                    $model->date_now = strtotime($model->date);
 	 		if($model->save())
			{
                            if($changed>0) $this->doMail($model,$changed);
				if($model->tour_i==0)
						$this->redirect(array('booking'));						
				else 
						$this->redirect(array('schedule'));
			}
		}
         $arrays=$this->dosched($model->city_id);
                $test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
                $this->render('sched',array(
                'model'=>$model,
                'arrays'=>$arrays,
               'info'=>$test,
        	));
	}

	public function actionShow($id)
	{
	    $id_control = Yii::app()->user->id;
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
   		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
        
        $this->render('show',array('model'=>$model,'info'=>$test,));
     }
	public function actionCurrent($id_sched)
	{
	
		$id_control = Yii::app()->user->id;
		$sched = SegScheduledTours::model()->with(array('guidestourinvoices'=>array('guidestourinvoicescustomers','contact')))->findByPk($id_sched);
		if(is_null($sched)) 	throw new CHttpException(404,'The requested tour does not exist.');
//		if($sched->additional_info2) $this->redirect(array('schedule'));
//		if($sched->additional_info2) $this->redirect(Yii::app()->createUrl("/filespdf/".$sched->additional_info2.".pdf"));
 			$date_format = strtotime($sched->date);
			$date_bd = date('Y-m-d',$date_format);
			$dt =$date_bd.' '.$sched->starttime;
	
			//mainoption

			$criteria_vat = new CDbCriteria;
			$criteria_vat->condition = 'name=:name ';
			$criteria_vat->params = array(':name'=>'Vat');
			$vat_nds = Mainoptions::model()->find($criteria_vat)->value;
			$criteria = new CDbCriteria;
                        $criteria->addCondition("idpayoptions in (1,2,3,4)");
//			$criteria->condition = 'idpayoptions=:idpayoptions1 OR idpayoptions=:idpayoptions2 OR idpayoptions=:idpayoptions3';
//			$criteria->params = array(':idpayoptions1' => 1,':idpayoptions2' => 2,':idpayoptions3' => 3);
			$pay = Payoptions::model()->findAll($criteria);
			$invoiceoptions_array = Invoiceoptions::model()->findAll(array('order'=>'id ASC')); 
			$dis = Bonus::model()->findAll(array('order'=>'sort ASC')); 
				if(!empty($_POST))
				{
					$pdf=$_POST['pdf'];

					foreach ($sched->guidestourinvoices as $invoice) {
					$model=$invoice->guidestourinvoicescustomers;
					$count_cust=0;
					$overAllIncome=0;
					$cashIncome=0;
					$invoice_id =  $invoice->idseg_guidesTourInvoices;			
					for($k=0;$k<count($model);$k++)
					{
						$kk=$model[$k]->idseg_guidesTourInvoicesCustomers;
						$count_cust++;
						$model[$k]->tourInvoiceid = $invoice_id;
						$model[$k]->customersName = $_POST['customersName'.$kk];
						$model[$k]->discounttype_id = $_POST['discounttype_id'.$kk];
						$model[$k]->paymentoptionid = $_POST['payoption'.$kk];
						$model[$k]->id_invoiceoptions = $_POST['option'.$kk];
						if(($model[$k]->paymentoptionid) &&($model[$k]->discounttype_id!=42))
						{
	
							$model[$k]->isPaid = 1;
							$model[$k]->price = $_POST['price'.$kk];
							$overAllIncome+=is_null($model[$k]->price)? 0 : $model[$k]->price;
							if($model[$k]->paymentoptionid==1) 
								$cashIncome+=is_null($model[$k]->price)? 0 : $model[$k]->price;
						}
                                                else {
							$model[$k]->isPaid = 0;
							$model[$k]->price = 0;
						}
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
				if($pdf){
					if(!$this->createpdf($sched)) return;
//					$this->redirect(Yii::app()->createUrl("/filespdf/".$sched->additional_info2.".pdf"));
					return;
				}
			}
	$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('current',array(
		'sched'=>$sched,
		'id_sched'=>$id_sched,
		'vat_nds'=>$vat_nds,
		'pay'=>$pay,
		'dis'=>$dis,
		'invoiceoptions_array'=>$invoiceoptions_array,
		'info'=>$test,
	));
	}
    public function actionInvoice($id)
	{
		$tour=null;
    	$id_control = Yii::app()->user->id;
		     $contact = new Bookq;
	    $model = SegGuidestourinvoices::model()->with(array('sched','contact','countCustomers'))->findByPk($id);

			$criteria_tours_link2 = new CDbCriteria;
            $criteria_tours_link2->condition = 'idseg_tourroutes=:idseg_tourroutes';
            $criteria_tours_link2->params = array(':idseg_tourroutes' => $model->sched->tourroute_id);
            $tours_guide = SegTourroutes::model()->findAll($criteria_tours_link2);
			$criteria = new CDbCriteria;
			 $criteria->condition = 'cityid=:cityid AND idseg_tourroutes=:id_tour_categories';
			 $criteria->params = array(':cityid' => $model->sched->city_id,':id_tour_categories'=>$model->sched->tourroute_id);
			 $tour = SegTourroutes::model()->find($criteria);
			 $contact->tour=$tour->idseg_tourroutes;
		 /*languages*/

            $languages_guide = Languages::model()->findByPk($model->sched->language_id);
 			 $contact->language=$model->sched->language_id;
 
			 $contact->tickets=$model->countCustomers;
			 $contact->firstname=$model->contact->firstname;
 			 $contact->lastname=$model->contact->surname;
 			 $contact->street=$model->contact->street;
 			 $contact->house=$model->contact->house;
 			 $contact->additional_address=$model->contact->additional_address;
 			 $contact->postalcode=$model->contact->postalcode;
 			 $contact->city=$model->contact->city;
 			 $contact->country=$model->contact->country;
 			 $contact->email=$model->contact->email;
 			 $contact->phone=$model->contact->phone;
       	if(isset($_POST['Bookq']))
		{
			$contact->attributes=$_POST['Bookq'];
            $ticket_count =	$contact->tickets-$model->countCustomers;
			if($contact->validate()){
								
				//save contact
				$user_contact =  SegContacts::model()->findByPk($model->contacts_id);
                $user_contact->firstname = $_POST['Bookq']['firstname'];
				$user_contact->surname = $_POST['Bookq']['lastname'];
				$user_contact->additional_address = $_POST['Bookq']['additional_address'];
				$user_contact->city = $_POST['Bookq']['city'];
				$user_contact->street = $_POST['Bookq']['street'];
				$user_contact->postalcode = $_POST['Bookq']['postalcode'];
//				$user_contact->house = $_POST['Bookq']['house'];
				$user_contact->country = $_POST['Bookq']['country'];
				$user_contact->phone = $_POST['Bookq']['phone'];
				$user_contact->email = $_POST['Bookq']['email'];
				$user_contact->save();
				//save guidestourinvoicecustomers
				if($ticket_count>0)
				{
				for($j=0;$j<$ticket_count;$j++){
					$guidestourinvoicescustomers = new SegGuidestourinvoicescustomers;
					$guidestourinvoicescustomers->customersName = $user_contact->firstname.' '.$user_contact->surname;
					$guidestourinvoicescustomers->price = 0;
					$guidestourinvoicescustomers->cityid = $model->sched->city_id;
					
					$guidestourinvoicescustomers->tourInvoiceid = $id;
					
					//$guidestourinvoicescustomers->CustomeInvoicNumber = ;
					$b = $tour->city['seg_cityname']{0};
					$year = date('y',time());
					$max= Yii::app()->db->createCommand("SELECT max(CustomerInvoiceNumber) from seg_guidestourinvoicescustomers where cityid=".$model->sched->city_id)->queryScalar();
					$max_i = $max+1;
					
					$guidestourinvoicescustomers->KA_string = 'KA'.$b.$year.'/'.$max_i;
					$guidestourinvoicescustomers->CustomerInvoiceNumber = $max_i;
					$guidestourinvoicescustomers->isPaid = 0;
//					$guidestourinvoicescustomers->origin_booking = $id_book;
					
					
					$guidestourinvoicescustomers->save();
					}
				}
				else if ($ticket_count<0)
				{
					$custs=SegGuidestourinvoicescustomers::model()->findAll(array('condition'=>'tourInvoiceid = :tourInvoiceid',
					'params'=>array(':tourInvoiceid'=>$id),'order'=>'KA_string desc'));
					$ticks=0;
					foreach ($custs as $cust){

						$cust->delete();
						$ticks--;
						if($ticks==$ticket_count) break;

					}
							
				}

					$scheduled=  SegScheduledTours::model()->findByPk($model->id_sched);
					$scheduled->current_subscribers=$scheduled->current_subscribers +$ticket_count;
					$scheduled->save();

            	//email
				$date_ex = date('d/m/Y',$scheduled->date_now);
				$x1 = strtotime($scheduled->starttime) - strtotime("00:00:00");
				$x2 = $tour->standard_duration*60;
				$x3 = $x1+$x2;
				$x4 = $x3+strtotime("00:00:00");
				$x5 = date('H:i:s',$x4);
				$tourend = $x5;
				
				$guidename = $scheduled->user_ob->contact_ob->firstname;
				$guidemnr = $scheduled->user_ob->contact_ob->phone;
				
				$message="Thank you for booking your city tour with Cherry Tours ".$scheduled->city_ob->seg_cityname;
				$message.="\n";
				$message.="\nWe have just reserved the following tour date for you:";
				$message.="\n".$date_ex;
				$message.="\nTour start: ".$scheduled->date_now." (Please show up at the assigned meeting point about 10 minutes before tour start.)";
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
					$this->redirect(array('booking'));
				
				}
			}
			}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

        $this->render('invoice',array(
			'scheduled'=>$model->sched,
			'contact'=>$contact,
			'tour'=>$tour,
			'tours_guide'=>$tours_guide,
			'languages_guide'=>$languages_guide,
			'info'=>$test,

				));
	}
    public function actionBooky($id_sched)
	{
		$tour=null;
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
				$criteria = new CDbCriteria;
				 $criteria->condition = 'cityid=:cityid AND idseg_tourroutes=:id_tour_categories';
				 $criteria->params = array(':cityid' => $scheduled->city_id,':id_tour_categories'=>$scheduled->tourroute_id);
				 $tour = SegTourroutes::model()->find($criteria);
			}
			$contact->attributes=$_POST['Bookq'];
			
			$ticket_array = SegTourroutes::model()->findByPk($scheduled->tourroute_id);
                        $ticket_count =	$contact->tickets;

/*			
			$cat_i = $_POST['Bookq']['cat_hidden'];
			if($cat_i == 1)$ticket_count = $_POST['Bookq']['tickets1'];
			if($cat_i == 2)$ticket_count = $_POST['Bookq']['tickets2'];
			if($cat_i == 3)$ticket_count = $_POST['Bookq']['tickets3'];
			$contact->tickets = $ticket_count;
  */
   

           if($contact->validate()){
								
				//save contact
				$user_contact =  new SegContacts;

                                $user_contact->firstname = $_POST['Bookq']['firstname'];
				$user_contact->surname = $_POST['Bookq']['lastname'];
				$user_contact->additional_address = $_POST['Bookq']['additional_address'];
				$user_contact->city = $_POST['Bookq']['city'];
				$user_contact->street = $_POST['Bookq']['street'];
				$user_contact->postalcode = $_POST['Bookq']['postalcode'];
//				$user_contact->house = $_POST['Bookq']['house'];
				$user_contact->country = $_POST['Bookq']['country'];
				$user_contact->phone = $_POST['Bookq']['phone'];
				$user_contact->email = $_POST['Bookq']['email'];
				$user_contact->save();
//			var_dump($_POST['Bookq']); return;
				
				//save booking
				$id_user = $user_contact->idcontacts;
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
					$guidestourinvoicescustomers->price = 0;
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
				$date_ex = date('d/m/Y',$scheduled->date_now);
				$x1 = strtotime($scheduled->starttime) - strtotime("00:00:00");
				$x2 = $tour->standard_duration*60;
				$x3 = $x1+$x2;
				$x4 = $x3+strtotime("00:00:00");
				$x5 = date('H:i:s',$x4);
				$tourend = $x5;
				
				$guidename = $scheduled->user_ob->contact_ob->firstname;
				$guidemnr = $scheduled->user_ob->contact_ob->phone;
				
				$message="Thank you for booking your city tour with Cherry Tours ".$scheduled->city_ob->seg_cityname;
				$message.="\n";
				$message.="\nWe have just reserved the following tour date for you:";
				$message.="\n".$date_ex;
				$message.="\nTour start: ".$scheduled->date_now." (Please show up at the assigned meeting point about 10 minutes before tour start.)";
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
					$this->redirect(array('current','id_sched'=>$id_sched));
				
				}
			}
		}
		
//		$criteria_cat = new CDbCriteria;
//        $criteria_cat->condition = 'cityid=:cityid AND id_tour_categories=:id_tour_categories';
//        $criteria_cat->params = array(':cityid' => $scheduled->city_id,':id_tour_categories'=>$cat);
//		$cat_item = SegTourroutes::model()->find($criteria_cat)->idseg_tourroutes;

				
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

        $this->render('book',array(
			'scheduled'=>$scheduled,
			'contact'=>$contact,
			'tour'=>$tour,
			'tours_guide'=>$tours_guide,
			'languages_guide'=>$languages_guide,
			'info'=>$test,

				));
    } 
	public function createpdf($sched)
	{
		
		$id_control = $sched->guide1_id;
        $guide = User::model()->with('contact_ob')->findByPk($id_control);
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
       $b = $tour->city['seg_cityname']{0};
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
//		$sched->GN_string = $fn.$ln.$c.'/'.$id_control.'/'.$year.'/'.$num;
		if($sched->GN_string=="")
		{
			$sched->GN_string = $fn.$ln.$c.'/'.$year.'/'.$num;	
		}
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
        $max= Yii::app()->db->createCommand("SELECT max(InvoiceNumber) from seg_guidestourinvoices where cityid=".$tour->cityid)->queryScalar();
        $max_i = $max+1;
      foreach ($sched->guidestourinvoices as $invoice) 
       {
			$model=$invoice->guidestourinvoicescustomers;
			$overAllIncome=0;
			$cashIncome=0;
			$count_inv=0;
			$invoice_id =  $invoice->idseg_guidesTourInvoices;
            for($k=0;$k<count($model);$k++){
                $kk=$model[$k]->idseg_guidesTourInvoicesCustomers;
				if($model[$k]->isPaid == 1)  $count_cust++;
                $count_inv++;
                }
               $invoice->status = 1;
               $sum_itog += $invoice->overAllIncome;
               $sum_bar += $invoice->cashIncome;
               $invoice->TA_string = 'TA'.$b.$year.'/'.$max_i;
               $invoice->InvoiceNumber =$max_i;
               $invoice->save();
               $tmpname=$this->doPDF($sched, $invoice);
               $mails[]=array($invoice->contact['email'],$tmpname);
        }
		$sum_vat = round($sum_itog*(1-1/($vat/100+1)),2);
		$sum_b_vat = $sum_itog - $sum_vat;
	
		$cifra = $count_cust - $tourroutes->guest_variable;
		if($cifra<=0){$cifra=0;}//turists >
		$gonorar = $tourroutes->base_provision+$cifra*$tourroutes->guestsMinforVariable;//summa gonorar
		$gonorar_vat = $gonorar*(1-1/($vat/100+1));
		$gonorar_vat = number_format($gonorar_vat, 2, '.', ' ');
		CashboxChangeRequests::model()->deleteAll("(id_type=1 OR id_type=2) AND sched_user_id=:sched_user_id", array(":sched_user_id"=>$sched->idseg_scheduled_tours));
		$cashnew=new CashboxChangeRequests;
		$cashnew->id_users=$id_control;
		$cashnew->approvedBy=$id_control;
		$cashnew->delta_cash = $sum_bar;
		$datetime = date('Y-m-d H:i:s', time());
		$cashnew->approval_date=$datetime;
		$cashnew->id_type = 1;
		$cashnew->sched_user_id = $sched->idseg_scheduled_tours;
		$cashnew->save();
		$cashnew1 = new CashboxChangeRequests;
		$cashnew1->id_users=$id_control;
		$cashnew1->approvedBy=$id_control;
		$cashnew1->approval_date=$datetime;
		$cashnew1->sched_user_id = $sched->idseg_scheduled_tours;
		$cashnew1->delta_cash = -$gonorar;
		$cashnew1->id_type = 2;
		$cashnew1->save();
		$command=Yii::app()->db->createCommand();
        $command->select('SUM(delta_cash) AS sum');
        $command->from('cashbox_change_requests');
        $command->where('id_users=:id', array(':id'=>$id_control));
        $cashnow= $command->queryScalar();	
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
		$forpdf['cashBefore'] = number_format($cashnow+$gonorar-$sum_bar, 2, '.', ' '); 
		$forpdf['sum_bar_zero'] = number_format($sum_bar, 2, '.', ' '); 
		$forpdf['cashnow_zero'] = number_format($cashnow, 2, '.', ' '); 
		$forpdf['delta_cash_zero'] = number_format($sum_bar-$gonorar, 2, '.', ' ');
		$forpdf['cashnow_enter'] = $forpdf['cashnow_zero']- $forpdf['gonorar_zero'];
		$name_pdf2=$this->doPDF($sched, $forpdf);
//		var_dump($mails);return false;
		$sched->additional_info2=$name_pdf2;
		$sched->save();
               $message="Dear sirs, \n The invoice from Cherry tours.";
                $subject = "The invoice from Cherry tours";
				foreach ($mails as $value) {
 				$this->sendMail($value[0],$subject,$message, __DIR__.'/../../../../filespdf/'.$value[1].'.pdf');
					unlink(__DIR__.'/../../../../filespdf/'.$value[1].'.pdf');
			}
	        $this->redirect( Yii::app()->createUrl('/filespdf/'.$name_pdf2.'.pdf') );
	}
	protected function doMail($model,$ch)
        {
                 $message="Dear sirs, \n The changes in your tour.\n";
                 if($ch>3)
                 {
                     $ch=$ch-4;
                     $message.="Your guide was changed. Your new guide is ".$model->user_ob->guidename.". Telephone:".$model->contact_ob->phone.".\n";
                 }
                 if($ch>1)
                 {
                     $ch=$ch-2;
                     $message.="Time of your tour was changed. Your tour's time is ".$model->starttime.".\n";
                 }
                if($ch>0)
                 {
                     $message.="Date of your tour was changed. Your tour's date is ".$model->date.".\n";
                 }
                    $message.="With all respect, Cherry Tours GmbH.\n";
                 
      foreach ($model->guidestourinvoices as $invoice) 
       {
   		$this->sendMail($invoice->contact['email'],"Changes from Cherry Tours GmbH",$message);
     
         }
        
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
			if(count($sched->guidestourinvoices)>0) $txt_num=$sched->guidestourinvoices[0]->TA_string;	
		}
 else {
		$txt_num=$invoice->TA_string;			
 }


		$tbl0 = '<table style="margin:30px;">
                        <tr>
                            <td>
                                <div style="color:#000000;font-size:20px;font-weight:bold;">Tourabrechnung<br></div> 
                                <table style="width:200px;">
                                    <tr>
                                            <td>Rechnungsnummer:</td>
											<td style="text-align:right;">'.$txt_num.'</td>
                                    </tr>
                                    <tr>
                                            <td>Rechnungsdatum:</td>
                                            <td style="text-align:right;">'.$date_format.'</td>
                                    </tr>
                                    <tr>
                                            <td>Uhrzeit:</td>
                                            <td style="text-align:right;">'.$time_format.'</td>
                                    </tr>
                                    <tr>
                                            <td>TourID:</td>
                                            <td style="text-align:right;">'.$sched->tourroute_id.'</td>
                                    </tr>
                                    <tr>
                                            <td>Seite:</td>
                                            <td style="text-align:center;">1 of 2</td>
                                    </tr>
                                </table> <br>
                                <div style="color:#000000;font-size:15px;">Tourgäste am '.$date_format.', '.$time_format.'</div>   
                            </td>
                            <td style="text-align:right;">';
                                $tbl_img = '<img src="'.Yii::app()->request->baseUrl.'/img/cherrytours_icon_black_rgb.jpg" width="100px"><div style="color:#000000;font-size:12px;font-weight:bold;padding-right:20px;">Cherrytours</div>';
                             $tbl01='</td></tr></table><hr style="border:1px solid #000000;">';
                                $tbl_array=array();

				$tbl02= '<table style="margin:30px;">
				  <tbody>
					<tr>
					  <th style="font-weight:bold;"><br>&nbsp;<br>Tourgastnummer<br></th>
					  <th style="font-weight:bold;"><br>&nbsp;<br>Name<br></th>
					  <th style="font-weight:bold;width:100px;"><br>&nbsp;<br>Rabatt/Gutschein<br></th>
					  <th style="font-weight:bold;"><br>&nbsp;<br>Zahlungsmittel<br></th>
					  <th style="font-weight:bold;width:50px;"><br>&nbsp;<br>Preis(inkl.USt.)<br></th>
					  <th style="font-weight:bold;width:50px;"><br>&nbsp;<br>USt.<br></th>
					  <th style="font-weight:bold;width:100px;text-align:center;"><br>&nbsp;<br>Option<br></th>
					</tr>';
					$vat= Yii::app()->db->createCommand("SELECT value from mainoptions where name='Vat'")->queryScalar();
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
						<td width="30%" style="text-align:left;">Gesamteinnahmen exklusive:</td>
						<td width="10%" style="text-align:right;">'.number_format($sum_b_vat, 2, '.', ' ').' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;">Umsatzsteuer: </td>
						<td style="text-align:right;">'.number_format($sum_vat, 2, '.', ' ').' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;">Anteil der Bareinnahmen inkl.: </td>
						<td style="text-align:right;">'.number_format($sum_itog, 2, '.', ' ').' &euro;</td>
					</tr>
						<tr>
						<td></td>
						<td style="text-align:left;font-weight:bold;">Gesamteinnahmen: </td>
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
				
				$name_pdf2 =str_replace("/", "-", $name_pdf1).'_'.$datename;
				if(!$is_full){$name_pdf2=$name_pdf2."_".$invoice_id;}
				$files_name1 = __DIR__.'/../../../../filespdf/'.$name_pdf2.'.pdf';
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
				<div style="color:#000000;font-size:20px;font-weight:bold;">Tourguide</div>
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
						  <td colspan="2" style="font-size:12x;font-weight:bold;">Honorarabrechnung:</td>
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
						  <td>Basishonorar:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['base_provision'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Steuernummer:</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->guide_ob['taxnumber'].'</td>
						  <td>Gastanzahl Variable:</td>
						  <td style="text-align:center;">'.$forpdf['cifra'].'x</td>
						  <td style="text-align:right;">'.$forpdf['guestsMinforVariable'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Finanzamt:</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->guide_ob['taxoffice'].'</td>
						  <td style="font-weight:bold;">Gesamthonorar:</td>
						  <td>&nbsp;</td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['gonorar_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>Guide\'s RechnungsNr.:</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->GN_string.'</td>
						  <td colspan="2">(inklusive '.$vat.'% vat:&nbsp;Umsatzsteuer:'.$forpdf['gonorar_vat'].'&nbsp;&euro;)</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>Das Honorar in Höhe von </td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['gonorar_zero'].'&nbsp;&euro;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>wurde von der Firma</td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['firma'].'</td>
						  <td style="font-size:12x;font-weight:bold;">Kassenbestand:</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>in Bar an</td>
						  <td style="font-weight:bold;text-align:right;">'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td>ausgezahlt</td>
						  <td>&nbsp;</td>
						  <td>Kassenbestand alt:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['cashBefore'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td colspan="2" style="font-weight:bold;">Ich bestätige den neuen Kassenbarbestand</td>
						  <td>Bareinnahmen:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['sum_bar_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td colspan="2" style="font-weight:bold;">von&nbsp;'.$forpdf['cashnow_zero'].'&nbsp;&euro;</td>
						  <td>Gesamthonorar:</td>
						  <td>&nbsp;</td>
						  <td style="text-align:right;">'.$forpdf['gonorar_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2" style="font-weight:bold;">Kassenbestandsänderung:</td>
						  <td style="font-weight:bold;text-align:right;">'.$forpdf['delta_cash_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="2">Kassenbestand neu: am '.$date_format.';'.$time_format.'</td>
						  <td style="text-align:right;">'.$forpdf['cashnow_zero'].'&nbsp;&euro;</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="3"><hr></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td colspan="3">Unterschrift&nbsp;'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
						</tr>
					  </tbody>
				</table>
			';
				$pdf->AddPage();
				$pdf->writeHTML($tbl_page2, true, false, false, false, '');

				}	
			
				$pdf->Output($files_name1, 'F');
	                            return $name_pdf2;

	}
	       	public function actionAjaxInfo()
	{
	if (!Yii::app()->request->isAjaxRequest)
			{
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>'No Request'));
//					'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
				exit;               
			}
		$id_sched = $_POST['id_sched'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$sched = SegScheduledTours::model()->findByPk($id_sched);

		$id_control = $sched->guide1_id;
		$guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    

   
		//sched
		
		//tour
		$tour = SegTourroutes::model()->findByPk($sched->tourroute_id);
		
		//tourroutes
		$criteria_tourroutes = new CDbCriteria;
		$criteria_tourroutes->condition = 'usersid=:usersid AND tourroutes_id=:tourroutes_id';
		$criteria_tourroutes->params = array(':usersid'=>$sched->user_ob->id,'tourroutes_id'=>$tour->id_tour_categories);
		$gonorar_tour = SegGuidesTourroutes::model()->find($criteria_tourroutes);
		
		//mainoption
		$criteria_vat = new CDbCriteria;
		$criteria_vat->condition = 'name=:name ';
		$criteria_vat->params = array(':name'=>'Vat');
		$vat = Mainoptions::model()->find($criteria_vat)->value;
				
		$command=Yii::app()->db->createCommand();
        $command->select('SUM(cashIncome) AS sumk');
        $command->from('seg_guidestourinvoices');
        $command->where('id_sched=:id_sched', array(':id_sched'=>$sched->idseg_scheduled_tours));
        $cashincome= $command->queryScalar();
        //segguidestourinvoicescustomers
        $invoicecustomer=SegGuidestourinvoicescustomers::model()->with('tourinvoice')->count("id_sched=:id_sched AND isPaid=:isPaid",array(":id_sched"=>$sched->idseg_scheduled_tours,":isPaid"=>1));

        $cifra = $invoicecustomer - $gonorar_tour->guest_variable;
		if($cifra<=0){$cifra=0;}//turists >
		$gonorar = $gonorar_tour->base_provision+$cifra*$gonorar_tour->guestsMinforVariable;//summa gonorar
			$command=Yii::app()->db->createCommand();
 //               $command->select('SUM(delta_cash) AS sum');
                $command->select('(SUM(delta_cash)- IFNULL((SELECT SUM(delta_cash) FROM cashbox_change_requests WHERE sched_user_id='.$sched->idseg_scheduled_tours.'),0)) AS sum');
                $command->from('cashbox_change_requests');
                $command->where('id_users=:id', array(':id'=>$id_control));
                $cashsum= $command->queryScalar();

		$result=$this->renderPartial('info',array(
			'gonorar_tour'=>$gonorar_tour,
			'cifra'=>$cifra,
			'gonorar'=>$gonorar,
			//'gonorar_vat'=>$gonorar_vat,
			'vat'=>$vat,
			'cash'=>$cashsum,
			'cashincome'=>$cashincome,
			
			'id_sched'=>$id_sched,
			'date'=>$date,
			'time'=>$time,
			'ajax'=>true,
		),true);
				echo CJSON::encode(array(
					'status'=>'failure', 
					'div'=>$result));
	}

        public function actionDispatch($pwd)
	{
		if(Yii::app()->params['mailPWD']==$pwd)
		{
			echo "<h1>".date("Y-m-d H:i:s")."</h1>";
        $guides = SegGuidesdata::model()->with(array('user_ob.contact_ob'=>array('select'=>'email,phone,firstname,surname'),'user_ob.scheds'=>array('condition'=>'isInvoiced_guide1=0','select'=>'date,starttime')))
					->findAll(array('condition'=>'invoiceCount2013>0','select'=>'idseg_guidesdata,invoiceCount2013,invoiceCount2014'));
			foreach($guides as $item){
				foreach($item['user_ob']['scheds'] as $it){
					$date_f=$it['date']."T".$it['starttime'];
					$diff=floor((strtotime($date_f)-time())/3600) ;
					if(($diff<=$item->invoiceCount2014)&&($diff>=0)){
						if(in_array($item->invoiceCount2013,[1,3])&&(strlen($item['user_ob']['contact_ob']['email'])>0))
							if($this->sendMail($item['user_ob']['contact_ob']['email'],"Tour at ".$it['starttime'],
									"Dear ".$item['user_ob']['contact_ob']['firstname']." ".$item['user_ob']['contact_ob']['surname'].". You have a tour scheduled at ".$it['date']." ".$it['starttime']."."))
							{
								$it->isInvoiced_guide1=1;
								$it->save();
							}
								
					}
					if($item->cancel_hours>0)
					{
					if($it->current_subscribers<$item->cancel_number)
					{
					if(($diff<=$item->cancel_hours)&&($diff>=0)){
						if(strlen($item['user_ob']['contact_ob']['email'])>0)
							if($this->sendMail($item['user_ob']['contact_ob']['email'],"Tour at ".$it['starttime'],
									"Dear ".$item['user_ob']['contact_ob']['firstname']." ".$item['user_ob']['contact_ob']['surname'].". Your tour scheduled at ".$it['date']." ".$it['starttime']." is canceled for the lack of guests."))
							{
								$it->isCanceled=1;
								$it->canceledBy=$item['user_ob']['id'];
								$it->save();
							}
							     foreach ($it->guidestourinvoices as $invoice) 
       {
									 if(strlen($invoice->contact['email'])>0){
   		$this->sendMail($invoice->contact['email'],"Tour at ".$it['starttime']." is canceled.",
				"Dear ".$invoice->contact['firstname']." ".$invoice->contact['firstname'].". Your tour scheduled at ".$it['date']." ".$it['starttime']." is canceled.");
     
         }
	   }

								
					}
					}
					}
				}
			}
		}
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
	public function loadGuideData($id)
	{
		$model=SegGuidesdata::model()->findByPk($id);
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
	public function loadGuideCity($id_user)
	{
            $criteria=new CDbCriteria;
            $criteria->condition='users_id=:usersid';
            $criteria->params=array(':usersid'=>$id_user);
		$model=SegGuidesCities::model()->find($criteria);
		if (!isset($model)) $model=new SegGuidesCities();
		return $model;
	}
	public function loadGTR($id)
	{
		$model=SegGuidesTourroutes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadLang($id)
	{
		$model=SegLanguagesGuides::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadCash($id)
	{
		$model=CashboxChangeRequests::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadTours()
	{
 		$model=CashboxChangeRequests::model()->with('user')->findAll('(approvedBy IS NULL) AND (reject=0)');
		if($model===null)
			throw new CHttpException(404,'The cashbox model does not exist.');
		return $model;
	}
	public function loadSchedTours()
	{
 		$model=SegScheduledTours::model()->findAll('date_now>=:date',array(':date'=>strtotime("midnight", time())));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadUnreported()
	{
        $id = Yii::app()->user->id;
		$model=SegScheduledTours::model()->findAll('date_now<:date AND openTour IS NULL AND language_id IS NOT NULL',array(':date'=>time()));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Bonus::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
		
	public function loadCR($id)
	{
		$model=CancellationReason::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
