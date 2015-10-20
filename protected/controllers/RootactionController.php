<?php
class RootactionController extends Controller
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
            
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('view','view_tours','view_scheduled','delete_users', 'delete_tours','delete_scheduled'),
                'roles'=>array('root'),                
				//'users'=>array('root'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /***************************************************************************************************/
	public function actionView()
	{
        $this->layout = "root";
        $this->render('view');
    }
   
	public function actionDelete_users()
	{
        $criteria=new CDbCriteria;
        $criteria->condition='id_usergroups<>:id_usergroups';
        $criteria->params=array(':id_usergroups'=>1);
        $users = User::model()->findAll($criteria);
        if(isset($users)){
             foreach($users as $user)
                $user->delete();
        }
        
        $criteria_contact=new CDbCriteria;
        $criteria_contact->condition='idcontacts<>:idcontacts';
        $criteria_contact->params=array(':idcontacts'=>42);
        $contscts = SegContacts::model()->findAll($criteria_contact);
        if(isset($contscts)){
             foreach($contscts as $contsct)
                $contsct->delete();
        }
        
        $guidesdatas = SegGuidesdata::model()->findAll();
        if(isset($guidesdatas)){
             foreach($guidesdatas as $guidesdata)
                $guidesdata->delete();
        }
        
        $guidescities = SegGuidesCities::model()->findAll();
        if(isset($guidescities)){
             foreach($guidescities as $guidescitie)
                $guidescitie->delete();
        }
        
        $guidestourroutes = SegGuidesTourroutes::model()->findAll();
        if(isset($guidestourroutes)){
             foreach($guidestourroutes as $guidestourroute)
                $guidestourroute->delete();
        }
        
        $langusgesguides = SegLanguagesGuides::model()->findAll();
        if(isset($langusgesguides)){
             foreach($langusgesguides as $langusgesguide)
                $langusgesguide->delete();
        }
	   		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    		//if(!isset($_GET['ajax']))
    		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        $this->redirect(array('main/system'));
	}
    
    /***************************************************************************************************/
   	public function actionView_tours()
	{
        $this->layout = "root";
        $this->render('view_tours');
    }
   
	public function actionDelete_tours()
	{
        $tourroutes = SegTourroutes::model()->findAll();
        if(isset($tourroutes)){
             foreach($tourroutes as $tourroute){
                //delete image
                if(($tourroute->pic_icon!="")or($tourroute->pic_icon!=NULL))unlink('image/tours/'.$tourroute->pic_icon);
                //delete pdf
                if(($tourroute->pdf_path!="")or($tourroute->pdf_path!=NULL))unlink('image/tourspdf/'.$tourroute->pdf_path);
                $tourroute->delete();
             }
        }
	   		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    		//if(!isset($_GET['ajax']))
    		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        $this->redirect(array('main/system'));
	}

    /***************************************************************************************************/    
    public function actionView_scheduled()
	{
        $this->layout = "root";
        $this->render('view_scheduled');
    }
   
	public function actionDelete_scheduled()
	{
        $models = SegScheduledTours::model()->findAll();
        if(isset($models)){
             foreach($models as $item){
                        $item->delete();
             }
        }
	   		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    		//if(!isset($_GET['ajax']))
    		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        $this->redirect(array('main/system'));
	}
}
