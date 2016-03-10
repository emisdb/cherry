<?php
class RootController extends Controller
{
	public $layout='/layouts/root_bs';
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
                'roles'=>array('root'),                
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
		  public function actionProfile()
	{

        $id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
         
        
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
     				    $this->redirect(array('uupdate','id'=>$id_user));
    		}
    
    		$test=array('guide'=>$model,'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
	  		$this->render('update_contact',array(
    			'model'=>$model,
				'id_user'=>$id_user,
				'update_user'=>$update_user,
   			'info'=>$test,
   		));
 }
	public function actionUupdate($id)
	{
        $id_control = Yii::app()->user->id;
    		$model=$this->loadModel($id);
    
    		// Uncomment the following line if AJAX validation is needed
    		// $this->performAjaxValidation($model);
    
    		if(isset($_POST['User']))
    		{
    			$model->attributes=$_POST['User'];
               // $model->id_usergroups = $_POST['User']['role_ob'];
    			if($model->save())
					 {
                        $this->redirect(array('uadmin'));
                    }
    		}
 		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
    
    		$this->render('update_user',array(
    			'model'=>$model,
  			'info'=>$test,
    		));
	}
	public function actionUadmin()
	{
	    $id_control = Yii::app()->user->id;
		$model=new User('search_root');
		$criteria=new CDbCriteria;
		$criteria->condition='groupname<>:groupname1';
		$criteria->params=array(':groupname1'=>'root');
		$usergroups = Usergroups::model()->findAll($criteria);
		//$modelsearch = $model->search_root();

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),
					'tours'=>$this->loadTours(),
					'todo'=>$this->loadUnreported());
		$this->render('admin',array(
			'model'=>$model,
			'usergroups'=>$usergroups,
  			'info'=>$test,
		));
	}
	 	public function actionUcreate()
	{
		$id_control = Yii::app()->user->id;
        $role_control = $this->loadModel($id_control)->id_usergroups;        

            $criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1';
            $criteria->params=array(':groupname1'=>'root');
            $usergroups = Usergroups::model()->findAll($criteria);
     
        $model=new User;
        $model_contact = new SegContacts;
 
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
		    //information profile
            $model->id_usergroups = $_POST['User']['role_ob'];
			$model->attributes=$_POST['User'];
            $model->status =1;  

            if($model_contact->save()){
                $model->id_contact =  $model_contact->idcontacts;
                 if($model->save())
                    $this->redirect(array('uupdate','id'=>$model->id));
            }
		}
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		$this->render('create_user',array(
			'model'=>$model,'usergroups'=>$usergroups,
            'modelc'=>$model_contact,
 			'info'=>$test,
		));
	}
	public function actionTadmin()
	{        
 		$model=new SegTourroutes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegTourroutes']))
			$model->attributes=$_GET['SegTourroutes'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		$this->render('tadmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionTcreate()
	{
			$model=new SegTourroutes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        $bigpic='';
        $pic='';
        $icon='';
        $pdf='';
         
		if(isset($_POST['SegTourroutes']))
		{
		    $model->image_big = CUploadedFile::getInstance($model,'image_big');
            $model->image = CUploadedFile::getInstance($model,'image');
            $image_icon = $model->image_icon = CUploadedFile::getInstance($model,'image_icon');
            $pdg_file1000 = $model->pdf_file = CUploadedFile::getInstance($model,'pdf_file');
     
            if($model->image_big!=""){
                $name_uniqid = uniqid();
                //$lnk_to_picture_old = $model->lnk_to_picture;
                $bigpic = $model->route_bigpic = $name_uniqid.'.jpg';
            }
            if($model->image!=""){
                $name_uniqid = uniqid();
                //$lnk_to_picture_old = $model->lnk_to_picture;
                $pic = $model->route_pic = $name_uniqid.'.jpg';
            }
            if($model->image_icon!=""){
                $name_uniqid = uniqid();
                //$lnk_to_picture_old = $model->lnk_to_picture;
                $icon = $model->pic_icon = $name_uniqid.'.jpg';
            }
            if($model->pdf_file!=""){
                $name_uniqid = uniqid();
                //$lnk_to_picture_old = $model->lnk_to_picture;
                $pdf = $model->pdf_path = $name_uniqid.'.pdf';
            }

            $model->cityid = $_POST['SegTourroutes']['city'];
            $model->id_tour_categories = $_POST['SegTourroutes']['tour_categories'];
			$model->attributes=$_POST['SegTourroutes'];
			if($model->save()){
                if($bigpic!=""){
                    //if(($lnk_to_picture_old!="")or($lnk_to_picture_old!=NULL))unlink('image/guide/'.$lnk_to_picture_old);
                    $file = 'image/tours/'.$bigpic;
                    $model->image_big->saveAs($file);
                }
                if($pic!=""){
                    //if(($lnk_to_picture_old!="")or($lnk_to_picture_old!=NULL))unlink('image/guide/'.$lnk_to_picture_old);
                    $file = 'image/tours/'.$pic;
                    $model->image->saveAs($file);
                }
                if($icon!=""){
                    $file = 'image/tours/'.$icon;
                    $image_icon->saveAs($file);
                }
                if($pdf!=""){
                     $file = 'image/tourspdf/'.$pdf;
                     if($pdg_file1000!=null){
                       $pdg_file1000->saveAs($file);
                     }
                }  
               	$this->redirect(array('tadmin'));         
            }
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		$this->render('tcreate',array(
			'model'=>$model,
			'info'=>$test,		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionTupdate($id)
	{
	     //access
		$model=$this->loadTourroute($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $bigpic='';
        $pic='';
        $icon='';
        $pdf='';
		if(isset($_POST['SegTourroutes']))
		{
		  
        
		    $model->image_big = CUploadedFile::getInstance($model,'image_big');
            $model->image = CUploadedFile::getInstance($model,'image');
            $image_icon = $model->image_icon = CUploadedFile::getInstance($model,'image_icon');
            $pdg_file1000 = $model->pdf_file = CUploadedFile::getInstance($model,'pdf_file');
            
            if($model->image_big!=""){
                $name_uniqid = uniqid();
                $route_bigpic_old = $model->route_bigpic;
                $bigpic = $model->route_bigpic = $name_uniqid.'.jpg';
            }
            if($model->image!=""){
                $name_uniqid = uniqid();
                $route_pic_old = $model->route_pic;
                $pic = $model->route_pic = $name_uniqid.'.jpg';
            }
            if($model->image_icon!=""){
                $name_uniqid = uniqid();
                $pic_icon_old = $model->pic_icon;
                $icon = $model->pic_icon = $name_uniqid.'.jpg';
            }
            if($model->pdf_file!=""){
                $name_uniqid = uniqid();
                $pdf_path_old = $model->pdf_path;
                $pdf = $model->pdf_path = $name_uniqid.'.pdf';
            }

            $model->cityid = $_POST['SegTourroutes']['city'];
            $model->id_tour_categories = $_POST['SegTourroutes']['tour_categories'];
			$model->attributes=$_POST['SegTourroutes'];
            
           //   print_r(	$model->base_price);
            
            
			if($model->save()){
			 
           //  print_r(	$model->base_price);
             
             
                if($bigpic!=""){
                    if(($route_bigpic_old!="")or($route_bigpic_old!=NULL))unlink('image/tours/'.$route_bigpic_old);
                    $file = 'image/tours/'.$bigpic;
                    $model->image_big->saveAs($file);
                }
                if($pic!=""){
                    if(($route_pic_old!="")or($route_pic_old!=NULL))unlink('image/tours/'.$route_pic_old);
                    $file = 'image/tours/'.$pic;
                    $model->image->saveAs($file);
                }
                if($image_icon!=""){
                    if(($pic_icon_old!="")or($pic_icon_old!=NULL))unlink('image/tours/'.$pic_icon_old);
                    $file = 'image/tours/'.$icon;
                    $image_icon->saveAs($file);
                }
                if($pdf!=""){
                     if(($pdf_path_old!="")or($pdf_path_old!=NULL))unlink('image/tourspdf/'.$pdf_path_old);
                     $file = 'image/tourspdf/'.$pdf;
                     if($pdg_file1000!=null){
                       $pdg_file1000->saveAs($file);
                     }
                }  
               	$this->redirect(array('tadmin'));         
            }
            
        }
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());
		$this->render('tupdate',array(
			'model'=>$model,
			'info'=>$test,
			));
	}
	public function actionUgadmin()
	{

		$model=new Usergroups('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usergroups']))
			$model->attributes=$_GET['Usergroups'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('ugadmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionLadmin()
	{
         
		$model=new Languages('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Languages']))
			$model->attributes=$_GET['Languages'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('ladmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionLcreate()
	{
   		$model=new Languages;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Languages']))
		{
			$model->attributes=$_POST['Languages'];
			if($model->save())
				$this->redirect(array('ladmin'));
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('lcreate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionLupdate($id)
	{
		$model=$this->loadLang($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Languages']))
		{
			$model->attributes=$_POST['Languages'];
			if($model->save())
				$this->redirect(array('ladmin'));
		}

			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('lupdate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
	public function actionCadmin()
	{
         
		$model=new SegCities('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegCities']))
			$model->attributes=$_GET['SegCities'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('cadmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionCcreate()
	{
   		$model=new SegCities;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegCities']))
		{
			$model->attributes=$_POST['SegCities'];
			if($model->save())
				$this->redirect(array('cadmin'));
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('ccreate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}

	public function actionCupdate($id)
	{
		$model=$this->loadCity($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegCities']))
		{
			$model->attributes=$_POST['SegCities'];
			if($model->save())
				$this->redirect(array('cadmin'));
		}

			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('cupdate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
		public function actionSadmin()
	{
         
		$model=new SegStarttimes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegStarttimes']))
			$model->attributes=$_GET['SegStarttimes'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('sadmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionScreate()
	{
   		$model=new SegStarttimes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegStarttimes']))
		{
			$model->attributes=$_POST['SegStarttimes'];
			if($model->save())
				$this->redirect(array('sadmin'));
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('screate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}

	public function actionSupdate($id)
	{
		$model=$this->loadStarttime($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegStarttimes']))
		{
			$model->attributes=$_POST['SegStarttimes'];
			if($model->save())
				$this->redirect(array('sadmin'));
		}

			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('supdate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
		public function actionBadmin()
	{
         
		$model=new Bonus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bonus']))
			$model->attributes=$_GET['Bonus'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('badmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionBcreate()
	{
   		$model=new Bonus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bonus']))
		{
			$model->attributes=$_POST['Bonus'];
			if($model->save())
				$this->redirect(array('badmin'));
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('bcreate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
	public function actionBupdate($id)
	{
		$model=$this->loadBonus($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bonus']))
		{
			$model->attributes=$_POST['Bonus'];
			if($model->save())
				$this->redirect(array('badmin'));
		}

			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('bupdate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
		public function actionTcadmin()
	{
         
		$model=new TourCategories('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TourCategories']))
			$model->attributes=$_GET['TourCategories'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('tcadmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionTccreate()
	{
   		$model=new TourCategories;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TourCategories']))
		{
			$model->attributes=$_POST['TourCategories'];
			if($model->save())
				$this->redirect(array('tcadmin'));
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('tccreate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
	public function actionTcupdate($id)
	{
		$model=$this->loadTC($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TourCategories']))
		{
			$model->attributes=$_POST['TourCategories'];
			if($model->save())
				$this->redirect(array('tcadmin'));
		}

			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('tcupdate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
			public function actionMoadmin()
	{
         
		$model=new Mainoptions('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mainoptions']))
			$model->attributes=$_GET['Mainoptions'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('moadmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionMocreate()
	{
   		$model=new Mainoptions;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mainoptions']))
		{
			$model->attributes=$_POST['Mainoptions'];
			if($model->save())
				$this->redirect(array('moadmin'));
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('mocreate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
	public function actionMoupdate($id)
	{
		$model=$this->loadMO($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mainoptions']))
		{
			$model->attributes=$_POST['Mainoptions'];
			if($model->save())
				$this->redirect(array('moadmin'));
		}

			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('moupdate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
	public function actionCtadmin()
	{
         
		$model=new CashboxType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CashboxType']))
			$model->attributes=$_GET['CashboxType'];
		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('ctadmin',array(
			'model'=>$model,
			'info'=>$test,
		));
	}
	public function actionCtcreate()
	{
   		$model=new CashboxType;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CashboxType']))
		{
			$model->attributes=$_POST['CashboxType'];
			if($model->save())
				$this->redirect(array('ctadmin'));
		}

		$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

		$this->render('ctcreate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
	public function actionCTupdate($id)
	{
		$model=$this->loadCT($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CashboxType']))
		{
			$model->attributes=$_POST['CashboxType'];
			if($model->save())
				$this->redirect(array('ctadmin'));
		}

			$test=array('guide'=>$this->loadContact(Yii::app()->user->cid),'tours'=>$this->loadTours(),'todo'=>$this->loadUnreported());

	$this->render('ctupdate',array(
				'info'=>$test,
		'model'=>$model,
		));
	}
	public function actionDelete($id,$type)
	{
		switch ($type)
		{
			case 1:
				$this->loadModel($id)->delete();
				$this->redirect(array('admin'));
				break;
			case 2:
				$this->loadTourroute($id)->delete();
				$this->redirect(array('tadmin'));
				break;
			case 3:
				$this->loadLang($id)->delete();
				$this->redirect(array('ladmin'));
				break;
			case 4:
				$this->loadCity($id)->delete();
				$this->redirect(array('cadmin'));
				break;
			case 5:
				$this->loadStarttime($id)->delete();
				$this->redirect(array('sadmin'));
				break;
			case 6:
				$this->loadBonus($id)->delete();
				$this->redirect(array('badmin'));
				break;
			case 7:
				$this->loadMO($id)->delete();
				$this->redirect(array('moadmin'));
				break;
			case 8:
				$this->loadCT($id)->delete();
				$this->redirect(array('ctadmin'));
		}
	}
	
	
	public function loadCT($id)
	{
		$model=CashboxType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadMO($id)
	{
		$model=Mainoptions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
		public function loadTC($id)
	{
		$model=TourCategories::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
		public function loadBonus($id)
	{
		$model=Bonus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadStarttime($id)
	{
		$model=SegStarttimes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadCity($id)
	{
		$model=SegCities::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadLang($id)
	{
		$model=Languages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
 	public function loadTourroute($id)
	{
		$model=SegTourroutes::model()->findByPk($id);
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
	public function loadTours()
	{
 		$model=CashboxChangeRequests::model()->with('user')->findAll('(approvedBy IS NULL) AND (reject=0)');
		if($model===null)
			throw new CHttpException(404,'The cashbox model does not exist.');
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

}
