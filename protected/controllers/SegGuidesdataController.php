<?php

class SegGuidesdataController extends Controller
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
				'actions'=>array('update','cashinfo'),
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
	    $this->layout = "admin";
		$model=new SegGuidesdata;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SegGuidesdata']))
		{
			$model->attributes=$_POST['SegGuidesdata'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idseg_guidesdata));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionCashinfo($id_user,$prim=0)
	{
		$id_control = Yii::app()->user->id;
		$role_control = User::model()->findByPk($id_control)->id_usergroups; 
		if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        if($role_control==3){
            $this->layout = "office";
        } 

		//guidesdata
		$user = User::model()->findByPk($id_user);
  		$guidesdata = SegGuidesdata::model()->findByPk($user->id_guide);
		
		
		
		//segguidestourroutes
		$criteria_t=new CDbCriteria;
		$criteria_t->condition='usersid=:usersid';
		$criteria_t->params=array(':usersid'=>$id_user);
		$link_tourroutes = SegGuidesTourroutes::model()->findAll($criteria_t);

		$array_tour = array();
		$array_tour_link = array();
		if(isset($link_tourroutes)) {
			
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



		if(isset($_POST['SegGuidesdata']))
		{
			$guidesdata->paysUSt = $_POST['SegGuidesdata']['paysUSt'];
			$guidesdata->inVoiceCount2015 = $_POST['SegGuidesdata']['inVoiceCount2015'];
			$guidesdata->taxnumber = $_POST['SegGuidesdata']['taxnumber'];
			$guidesdata->taxoffice = $_POST['SegGuidesdata']['taxoffice'];			
			$guidesdata->BIC = $_POST['SegGuidesdata']['BIC'];
			$guidesdata->IBAN = $_POST['SegGuidesdata']['IBAN'];
			$guidesdata->save();
			  
		}
		$j=0;
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
		
		if((isset($_POST['SegGuidesdata']))or(isset($_POST['SegGuidesTourroutes']))){
			
			
			$this->redirect(array('cashinfo','id_user'=>$id_user,'prim'=>1));	
		}
		
		$this->render('cashinfo',array(
			'link_tourroutes'=>$link_tourroutes,
			'guidesdata'=>$guidesdata,
			'user'=>$user,
			'array_tour' => $array_tour,
			'array_tour_link' => $array_tour_link,
			'prim'=>$prim,
		));     
	}

	public function actionUpdate($id,$id_user)
	{
	    $id_control = Yii::app()->user->id;
        $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;        
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
        
		$model=$this->loadModel($id);
		
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
				$this->redirect(array('user/update','id'=>$id_user));
            }
		}

		$this->render('update',array(
			'model'=>$model,
			'id_user'=>$id_user,
			'update_user'=>$update_user,
			'istourroutes'=>$istourroutes,
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
		$dataProvider=new CActiveDataProvider('SegGuidesdata');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    $this->layout = "admin";
		$model=new SegGuidesdata('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegGuidesdata']))
			$model->attributes=$_GET['SegGuidesdata'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SegGuidesdata the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SegGuidesdata::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SegGuidesdata $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seg-guidesdata-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
