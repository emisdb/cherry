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
		$this->render('create',array(
			'model'=>$model,'usergroups'=>$usergroups,
 			'info'=>$test,
		));
	}

	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
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
