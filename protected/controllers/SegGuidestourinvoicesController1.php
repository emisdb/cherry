<?php

class SegGuidestourinvoicesController extends Controller
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
				'actions'=>array('current'),
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

	public function actionCurrent($id_tour=null,$date=null,$time=null)//Invoicescustomer()
	{
		$id_control = Yii::app()->user->id;
        $guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
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
			
			$date_format = strtotime($date);
			$date_bd = date('Y-m-d',$date_format);
			$dt =$date_bd.' '.$time;
		
			/*$invoicescustomer*/$model = new SegGuidestourinvoicescustomers;
			if(isset($_POST['SegGuidestourinvoicescustomer']))
			{
			
			}
								
			$this->render('current',array('model'=>$model,'guide'=>$guide));
		}
	}

public function actionCurrent1($id_schedtour=null,$date=null,$time=null)
	{
		/*print_r('999');
		print_r($id_tour);
				print_r('999');
		print_r($date);
				print_r('999');
		print_r($time);*/
		
		$id_control = Yii::app()->user->id;
        $guide = User::model()->findByPk($id_control);
        $role_control = $guide->id_usergroups;    
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
			
			$date_format = strtotime($date);
			$date_bd = date('Y-m-d',$date_format);
			$dt =$date_bd.' '.$time;

	//print_r($dt);
	
				
				$criteria_contact = new CDbCriteria;
				$criteria_contact->alias = 's';
				$criteria_contact->join = 'LEFT JOIN seg_scheduled_tours as sc ON sc.idseg_scheduled_tours=s.sched_tourid';
				$criteria_contact->condition = 'Concat(sc.date," ",sc.starttime)=:dt';
				$criteria_contact->params = array(':dt' => $dt);
				$model = SegBookings::model()->findAll($criteria_contact);
				
				//print_r($dt);
				
				if(!empty($_POST))
				{
					//$model->attributes=$_POST['SegScheduledTours'];
					//if($model->save())
						//$this->redirect(array('officeadmin'));
						print_r($_POST);
						//print_r('00');
				}
	
					
				$this->render('current',array('model'=>$model,'guide'=>$guide));
		
			
        }   
	
	}
    

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SegGuidestourinvoices;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegGuidestourinvoices']))
		{
			$model->attributes=$_POST['SegGuidestourinvoices'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_guidesTourInvoices));
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

		if(isset($_POST['SegGuidestourinvoices']))
		{
			$model->attributes=$_POST['SegGuidestourinvoices'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_guidesTourInvoices));
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
		$dataProvider=new CActiveDataProvider('SegGuidestourinvoices');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SegGuidestourinvoices('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegGuidestourinvoices']))
			$model->attributes=$_GET['SegGuidestourinvoices'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SegGuidestourinvoices the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SegGuidestourinvoices::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SegGuidestourinvoices $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seg-guidestourinvoices-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
