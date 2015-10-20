<?php

class SegGuidesTourroutesController extends Controller
{

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
                'roles'=>array('guide'),
				//'users'=>array('@'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
                'roles'=>array('office'),                
				//'users'=>array('@'),
			),
           	array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=new SegGuidesTourroutes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegGuidesTourroutes']))
		{
			$model->attributes=$_POST['SegGuidesTourroutes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_guides_tourroutes));
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
	public function actionUpdate($id_user)
	{
	    $id_control = Yii::app()->user->id;
        $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
        
        $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
        if($role_control==1){
            $this->layout = "root";
            //$usergroups = Usergroups::model()->findAll();
        }        
        if($role_control==2){
            $this->layout = "admin";
           	//$criteria=new CDbCriteria;
            //$criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2';
            //$criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin');
            //$usergroups = Usergroups::model()->findAll($criteria);
        }   
        if($role_control==3){
            $this->layout = "office";
    	    //$criteria=new CDbCriteria;
            //$criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
           // $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
            //$usergroups = Usergroups::model()->findAll($criteria);
        }     
        $tours_all=TourCategories::model()->findAll();
        $criteria=new CDbCriteria;
        $criteria->condition='usersid=:usersid';
        $criteria->params=array(':usersid'=>$id_user);
        $tours = SegGuidesTourroutes::model()->findAll($criteria);

    
         
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(!empty($_POST))
		{
		       if(count($tours)>0){
		          foreach($tours as $tours_item){
		                $this->loadModel($tours_item->idseg_guides_tourroutes)->delete(); 
                      
		          }
               }
		       for($i=1;$i<count($tours_all)+1;$i++){
		          if(isset($_POST['tours'.$i])){
		              $model = new SegGuidesTourroutes;
                      $model->usersid = $id_user;
                      $model->tourroutes_id = $_POST['tours'.$i];
                      $model->save();
		          }
                }
                $this->redirect(array('segGuidesdata/update','id'=>$id_guide,'id_user'=>$update_user->id));

		//	$model->attributes=$_POST['SegGuidesCities'];
          //  $model->users_id = $id_user;
            
		//	if($model->save())
		//		$this->redirect(array('segguidesdata/update','id'=>$id_guide,'id_user'=>$update_user->id));
              
		}

		$this->render('update',array(
			'tours_all'=>$tours_all,'update_user'=>$update_user,'id_guide'=>$id_guide,'tours'=>$tours
		));
       
       
       /*
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegLanguagesGuides']))
		{
			$model->attributes=$_POST['SegLanguagesGuides'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_languages_guides));
		}

		$this->render('update',array(
			'model'=>$model,
		));*/
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
		$dataProvider=new CActiveDataProvider('SegGuidesTourroutes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SegGuidesTourroutes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegGuidesTourroutes']))
			$model->attributes=$_GET['SegGuidesTourroutes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SegGuidesTourroutes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SegGuidesTourroutes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SegGuidesTourroutes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seg-guides-tourroutes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
