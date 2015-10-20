<?php

class SegTourroutesController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
             //   'roles'=>array('guede'),                
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
                'roles'=>array('guide'),
				//'users'=>array('@'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
                'roles'=>array('office'),                
				//'users'=>array('@'),
			),
           	array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
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
	/*public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}*/

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	     //access
	    $id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups; 
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        
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
               	$this->redirect(array('admin'));         
            }
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
	     //access
	    $id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups; 
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   
        
		$model=$this->loadModel($id);

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
               	$this->redirect(array('admin'));         
            }
            
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
	   
       $criteria=new CDbCriteria;
       $criteria->condition='idseg_tourroutes=:idseg_tourroutes';
       $criteria->params=array(':idseg_tourroutes'=>$id);
       $tourroute = SegTourroutes::model()->find($criteria);
       //delete image
       if(($tourroute->pic_icon!="")or($tourroute->pic_icon!=NULL))unlink('image/tours/'.$tourroute->pic_icon);
       //delete pdf
       if(($tourroute->pdf_path!="")or($tourroute->pdf_path!=NULL))unlink('image/tourspdf/'.$tourroute->pdf_path);
       $tourroute->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	/*public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SegTourroutes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}*/

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{        
        //access
	    $id_control = Yii::app()->user->id;
        $role_control = User::model()->findByPk($id_control)->id_usergroups; 
        if($role_control==1){
            $this->layout = "root";
        }        
        if($role_control==2){
            $this->layout = "admin";
        }   

		$model=new SegTourroutes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SegTourroutes']))
			$model->attributes=$_GET['SegTourroutes'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SegTourroutes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SegTourroutes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SegTourroutes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='seg-tourroutes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
