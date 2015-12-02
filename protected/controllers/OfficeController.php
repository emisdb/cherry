<?php
class OfficeController extends Controller
{
	public $layout='//layouts/office_bs';
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	 	public $cashsum=0;
        
        public function init() {
                parent::init();
  		$command=Yii::app()->db->createCommand();
        $command->select('SUM(delta_cash) AS sum');
        $command->from('cashbox_change_requests');
        $command->where('approvedBy IS NOT NULL', array(':id'=>Yii::app()->user->id));

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
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
    				if($id==$id_control){
    				    $this->redirect(array('profile'));
                    } else {
                        $this->redirect(array('admin'));
                    }
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
	public function actionApprove()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$comment=$this->loadModel();
			$comment->approve();
			$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
  		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
    		if(isset($_POST['User']))
    		{
    			$model->attributes=$_POST['User'];
               // $model->id_usergroups = $_POST['User']['role_ob'];
    			if($model->save())
				{
    				    $this->redirect(array('profile'));
                    } 
    		}
    
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
  
    		$this->render('contact',array(
    			'model'=>$model,'id_user'=>$id,
				'update_user'=>$update_user,
  			'info'=>$test,
				));
  }
	public function actionUcontact($id,$id_user)
	{
	    $id_control = Yii::app()->user->id;
        $update_user = User::model()->findByPk($id_user);
            
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
           		if($model->save())
                          $this->redirect(array('profile'));
    		}
    		$test=array('guide'=>$model,'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
  
    		$this->render('contact',array(
    			'model'=>$model,'id_user'=>$id,
				'update_user'=>$update_user,
  			'info'=>$test,
				));
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
	
	public function loadCR($id)
	{
		$model=CancellationReason::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	 
	public function actionAdmin()
	{
	    $id_control = Yii::app()->user->id;

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
			'model'=>$model,'role_control'=>$role_control,'usergroups'=>$usergroups,
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
		$command= Yii::app()->db->createCommand("SELECT seg_tourroutes.idseg_tourroutes AS tid, seg_tourroutes.name AS tnam, seg_tourroutes.TNmax AS tmax,
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
				$routs[$row['tid']]=array($row['tid'],$row['tnam'],array($row['lid']),array($row['uid']),$row['tmax'],);
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
			$model->attributes=$_POST['SegScheduledTours'];
	        $model->date_now = strtotime($model->date);
            $model->original_starttime = explode(":",$model->starttime)[0].":00";
	 		if($model->save())
					$this->redirect(array('schedule'));
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
			$criteria->condition = 'idpayoptions=:idpayoptions1 OR idpayoptions=:idpayoptions2 OR idpayoptions=:idpayoptions3';
			$criteria->params = array(':idpayoptions1' => 1,':idpayoptions2' => 2,':idpayoptions3' => 3);
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
    public function actionBook($id_sched)
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
				$user_contact->house = $_POST['Bookq']['house'];
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
 				$this->sendMail($value[0],$subject,$message, __DIR__.'/../../filespdf/'.$value[1].'.pdf');
					unlink(__DIR__.'/../../filespdf/'.$value[1].'.pdf');
			}
	        $this->redirect( Yii::app()->createUrl('/filespdf/'.$name_pdf2.'.pdf') );
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
                                <div style="color:#000000;font-size:20px;font-weight:bold;">Route Accounting<br></div> 
                                <table style="width:200px;">
                                    <tr>
                                            <td>Invoice number:</td>
											<td style="text-align:right;">'.$txt_num.'</td>
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
				
				$name_pdf2 =str_replace("/", "-", $name_pdf1).'_'.$datename;
				if(!$is_full){$name_pdf2=$name_pdf2."_".$invoice_id;}
				$files_name1 = __DIR__.'/../../filespdf/'.$name_pdf2.'.pdf';
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
						  <td colspan="2" style="font-weight:bold;">von&nbsp;'.$forpdf['cashnow_zero'].'&nbsp;&euro;</td>
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
						  <td colspan="3">Signature&nbsp;'.$sched->user_ob->contact_ob['firstname'].' '.$sched->user_ob->contact_ob['surname'].'</td>
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

	protected function sendMail($to,$subject,$body,$att=null)
	{
		        Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
				$message->setBody($body);
                $message->subject = $subject;
               $message->addTo($to);
                $message->from = Yii::app()->params['adminEmail'];
  				if($att){
					$swiftAttachment = Swift_Attachment::fromPath($att); 
					$message->attach($swiftAttachment);
				}
               return Yii::app()->mail->send($message);
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
	public function loadTours()
	{
 		$model=CashboxChangeRequests::model()->with('user')->findAll('approvedBy IS NULL');
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
}
