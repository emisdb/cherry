<?php

class CashboxHistoryController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
	       		'users'=>array('*'),  
			),
		    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('history','view'),
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
	
	public function actionHistory($id)
	{
		$id_control = Yii::app()->user->id;
		$guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
         
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
		$criteria->condition = 'users_id=:users_id';
		$criteria->params = array(':users_id'=>$id);
		$history = CashboxHistory::model()->findAll($criteria);
		
		$this->render('history',array(
			'history'=>$history,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$id_control = Yii::app()->user->id;
		$guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
         
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
		$item = $this->loadModel($id);
		
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

		$this->render('view',array(
			'guide_name'=>$guide_name,
			'guide_id'=>$guide_id,
			'tour_id'=>$tour_id,
			'invoice_name'=>$invoice_name,
			'item'=>$item,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$model=new CashboxHistory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CashboxHistory']))
		{
			$model->attributes=$_POST['CashboxHistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idcashbox_history));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CashboxHistory']))
		{
			$model->attributes=$_POST['CashboxHistory'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idcashbox_history));
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
		$dataProvider=new CActiveDataProvider('CashboxHistory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CashboxHistory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CashboxHistory']))
			$model->attributes=$_GET['CashboxHistory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CashboxHistory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CashboxHistory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CashboxHistory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cashbox-history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
