<?php
class MainController extends Controller
{
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
				'actions'=>array('index','index1','index0','index2','index3'),
	       		'users'=>array('*'),  
              //   'roles'=>a//rray('guede'),                
			),
        
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('system','sys'),
                'roles'=>array('guide'),
				//'users'=>array('@'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
                'roles'=>array('office'),                
				//'users'=>array('@'),
			),
           	array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
			//	'users'=>array('root'),
                'roles'=>array('admin'),                
			),            
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
                'roles'=>array('root'),                
				//'users'=>array('root'),
			),
			array('deny',  // deny all users
            
				'users'=>array('*'),
			),
		);
	}

	
    
   	public function actionSystem()
	{
	    $id = Yii::app()->user->id;
        $model=User::model()->findByPk($id);
        
        if($model->id_usergroups == 1) {
              $this->layout = "root";
		     
        }//root
        if($model->id_usergroups == 2) {
   				$this->redirect('main/system');
           $this->layout = "admin";
		   
        }//root   
                if($model->id_usergroups == 3) {
		          $this->redirect( Yii::app()->createUrl('office/profile') );

//              $this->layout = "office";
		      
        }//root
                if($model->id_usergroups == 4) {
              $this->layout = "partner";
		    
        }//root
                if($model->id_usergroups == 5) {
		          $this->redirect( Yii::app()->createUrl('guide/weeks',array('date'=>date("d.m.Y"))) );
   
//              $this->layout = "guide";
		    
        }//root
        
          $this->render('system');     
       
	}
   	public function actionSys()
	{
	    $id = Yii::app()->user->id;
        $model=User::model()->findByPk($id);
        
        if($model->id_usergroups == 1) {
              $this->layout = "root";
		     
        }//root
        if($model->id_usergroups == 2) {
              $this->layout = "admin";
		   
        }//root   
                if($model->id_usergroups == 3) {
              $this->layout = "office";
		      
        }//root
                if($model->id_usergroups == 4) {
              $this->layout = "partner";
		    
        }//root
                if($model->id_usergroups == 5) {
              $this->layout = "guide_bs";
		    
        }//root
        
          $this->render('system');     
       
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
		$model=new Main;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Main']))
		{
			$model->attributes=$_POST['Main'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	    $this->layout = "admin";
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Main']))
		{
			$model->attributes=$_POST['Main'];
			if($model->save())
				$this->redirect(array('user/system'));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        //$id_control = Yii::app()->user->id;
        //$role_control = User::model()->findByPk($id_control)->id_usergroups;    
         
        if(Yii::app()->user->isGuest){
            $this->layout = "nosite";
        }else{
            $this->layout = "test";
        }
        
	    
        //$id = 1;
		//$model=$this->loadModel($id);
		$this->render('index');
	}


	public function actionIndex0()//variant bez display
	{
              $this->layout = "test";
  		$this->render('index');
	}
	public function actionIndex1()//variant bez display
	{
        if(Yii::app()->user->isGuest){
            $this->layout = "nosite";
        }else{
            $this->layout = "test1";
        }
		$this->render('index');
	}

	public function actionIndex2()//variant webkit style no
	{
        if(Yii::app()->user->isGuest){
            $this->layout = "nosite";
        }else{
            $this->layout = "test2";
        }
		$this->render('index');
	}


	public function actionIndex3()//variant 3
	{
        if(Yii::app()->user->isGuest){
            $this->layout = "nosite";
        }else{
            $this->layout = "test3";
        }
		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Main('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Main']))
			$model->attributes=$_GET['Main'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Main the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Main::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Main $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='main-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
