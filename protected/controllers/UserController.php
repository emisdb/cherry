<?php
class UserController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','profile','update'),
                'roles'=>array('guide'),
			),            
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','delete','create'),
                'roles'=>array('office'),                
			),
           	array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('list_admin','delete_admin','create_admin','update_admin'),
                'roles'=>array('admin'),                
			),            
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('list_root','delete_root','create_root','update_root'),
                'roles'=>array('root'),                
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionProfile()
	{

        $id_control = Yii::app()->user->id;
        // $update_user = User::model()->findByPk($id_user);
        $role_control = User::model()->findByPk($id_control)->id_usergroups;    
        //  $id_guide = SegGuidesdata::model()->findByPk($update_user->id_guide)->idseg_guidesdata;
         
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
        
        $id = Yii::app()->user->id;
        $model=$this->loadModel($id);
		
		/*CASH*/
		if($role_control==5){
			//guidesdata
			$user = User::model()->findByPk($id);
  			$guidesdata = SegGuidesdata::model()->findByPk($user->id_guide);

			//segguidestourroutes
			$criteria_t=new CDbCriteria;
			$criteria_t->condition='usersid=:usersid';
			$criteria_t->params=array(':usersid'=>$id);
			$link_tourroutes = SegGuidesTourroutes::model()->findAll($criteria_t);
	
			$array_tour = array();
			$array_tour_link = array();
			if(isset($link_tourroutes)) {
				
				$criteria_a=new CDbCriteria;
				$criteria_a->condition='users_id=:users_id';
				$criteria_a->params=array(':users_id'=>$id);
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
		}
              
        /*CITY*/
        $criteria_city = new CDbCriteria;
        $criteria_city->condition = 'users_id=:users_id';
        $criteria_city->params = array(':users_id' => $id);
        $city_link = SegGuidesCities::model()->find($criteria_city);
       
        $city='';
        if(isset($city_link))$city = SegCities::model()->findByPk($city_link->cities_id);

        /*TOUR*/
        $criteria = new CDbCriteria;
        $criteria->condition = 'usersid=:usersid';
        $criteria->params = array(':usersid' => $id);
        $tourcat = SegGuidesTourroutes::model()->findAll($criteria);

        $tour_categories_user='';
        if(isset($tourcat)){
            $j=0;
            foreach($tourcat as $tourcat_item){
                $model_tour = new TourUser;
                
                $criteria_tourcat = new CDbCriteria;
                $criteria_tourcat->condition = 'id_tour_categories=:id_tour_categories';
                $criteria_tourcat->params = array(':id_tour_categories' => $tourcat_item->tourroutes_id);
                $name_tourcat = TourCategories::model()->find($criteria_tourcat);
                $model_tour->cat = $name_tourcat->name;
                
                $criteria_tour = new CDbCriteria;
                $criteria_tour->condition = 'id_tour_categories=:id_tour_categories AND cityid=:cityid';
                $criteria_tour->params = array(':id_tour_categories' => $tourcat_item->tourroutes_id, ':cityid' => $city->idseg_cities);
                $tour = SegTourroutes::model()->find($criteria_tour);
                $model_tour->tourname = $tour->name;
                
                $tour_categories_user[$j]=$model_tour;
                $j++;
            }
        }else{$tourcat='';}
        
        /*LANGUADGE*/
        $criteria_lan = new CDbCriteria;
        $criteria_lan->condition = 'users_id=:users_id';
        $criteria_lan->params = array(':users_id' => $id);
        $lancat = SegLanguagesGuides::model()->findAll($criteria_lan);
        
        $lan_ob_user='';
        if(isset($lancat)){
            $i=0;
            foreach($lancat as $lancat_item){
                $criteria_lani = new CDbCriteria;
                $criteria_lani->condition = 'id_languages=:id_languages';
                $criteria_lani->params = array(':id_languages' => $lancat_item->languages_id);
                $lan_ob = Languages::model()->find($criteria_lani);
                $lan_ob_user[$i]=$lan_ob;
                $i++;
            }
        }else{$lancat='';}

		if($role_control==5){
			 $this->render('profile',array(
				'model'=>$model,
				'tourcat'=>$tour_categories_user,
				'lan_obs'=>$lan_ob_user, 
				'city'=>$city,
				/*cash*/
				'link_tourroutes'=>$link_tourroutes,
				'guidesdata'=>$guidesdata,
				'user'=>$user,
				'array_tour' => $array_tour,
				'array_tour_link' => $array_tour_link,
			));
		} else{	
			$this->render('profile',array(
				'model'=>$model,
				'tourcat'=>$tour_categories_user,
				'lan_obs'=>$lan_ob_user, 
				'city'=>$city,
			));
		}
    }

    public function actionSystem()
	{
        $this->layout = "admin";
        $this->render('system',array(
			//'model'=>$model,
		));
        
    }
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
 	public function actionCreate()
	{
		$id_control = Yii::app()->user->id;
        $role_control = $this->loadModel($id_control)->id_usergroups;        
        if($role_control==1){
            $this->layout = "root";
            $criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1';
            $criteria->params=array(':groupname1'=>'root');
            $usergroups = Usergroups::model()->findAll($criteria);
        }        
        if($role_control==2){
            $this->layout = "admin";
           	$criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2';
            $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin');
            $usergroups = Usergroups::model()->findAll($criteria);
        }   
        if($role_control==3){
            $this->layout = "office";
    	    $criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
            $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
            $usergroups = Usergroups::model()->findAll($criteria);
        }     
        
        $model=new User;
        $model_contact = new SegContacts;
        $model_guide = new SegGuidesdata;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
		    //information profile
            $model->id_usergroups = $_POST['User']['role_ob'];
			$model->attributes=$_POST['User'];
            $model->status =1;  

            if($model_contact->save()){
                $model->id_contact =  Yii::app()->db->getLastInsertId();
                if($model->id_usergroups==5){
                    if($model_guide->save())
                        $model->id_guide =  Yii::app()->db->getLastInsertId();
                }
                if($model->save())
                    $this->redirect(array('update','id'=>Yii::app()->db->getLastInsertId()));
            }
		}
		$this->render('create',array(
			'model'=>$model,'usergroups'=>$usergroups//, 'contacts'=>$model_contact, 'guide'=>$model_guide
		));
	}

	public function actionUpdate($id)
	{
        $id_control = Yii::app()->user->id;
        $role_control = $this->loadModel($id_control)->id_usergroups; 

        //update access
        $is_control=0;
        $role_update = $this->loadModel($id)->id_usergroups; 
        if($id_control==$id) $is_control = 1;
        if($role_control==1) $is_control = 1;
        if(($role_control==2)and($role_update<>1)) $is_control = 1;
        if(($role_control==3)and($role_update<>1)and($role_update<>2)) $is_control = 1;   
        if($is_control==1) {  
               
            if($role_control==1){
                $this->layout = "root";
               /*	$criteria=new CDbCriteria;
                $criteria->condition='groupname<>:groupname1';
                $criteria->params=array(':groupname1'=>'root');
                $usergroups = Usergroups::model()->findAll($criteria);*/
             }        
            if($role_control==2){
                $this->layout = "admin";
               /*	$criteria=new CDbCriteria;
                $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2';
                $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin');
                $usergroups = Usergroups::model()->findAll($criteria);*/
            }   
            if($role_control==3){
                $this->layout = "office";
        	   /* $criteria=new CDbCriteria;
                $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
                $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
                $usergroups = Usergroups::model()->findAll($criteria);*/
            }   
            if($role_control==5){
                $this->layout = "guide";
        	   /* $criteria=new CDbCriteria;
                $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
                $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
                $usergroups = Usergroups::model()->findAll($criteria);*/
            }   
            
    		$model=$this->loadModel($id);
    
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
    
    		$this->render('update',array(
    			'model'=>$model//,'usergroups'=>$usergroups
    		));
        }else{
            $this->redirect(array('main/system'));
        }
	}
   
	public function actionDelete($id)
	{
	   
        $id_control = Yii::app()->user->id;
        $role_control = $this->loadModel($id_control)->id_usergroups; 
        
        
        //update access
        $is_control=0;
        $role_update = $this->loadModel($id)->id_usergroups; 
        if($role_control==1) $is_control = 1;
        if(($role_control==2)and($role_update<>1)and($role_update<>2)) $is_control = 1;
        if(($role_control==3)and($role_update<>1)and($role_update<>2)and($role_update<>3)) $is_control = 1;   
        if($is_control==1) {  
               
          /*  if($role_control==1){
                $this->layout = "root";
               	$criteria=new CDbCriteria;
                $criteria->condition='groupname<>:groupname1';
                $criteria->params=array(':groupname1'=>'root');
                $usergroups = Usergroups::model()->findAll($criteria);
             }        
            if($role_control==2){
                $this->layout = "admin";
               	$criteria=new CDbCriteria;
                $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2';
                $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin');
                $usergroups = Usergroups::model()->findAll($criteria);
            }   
            if($role_control==3){
                $this->layout = "office";
        	    $criteria=new CDbCriteria;
                $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
                $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
                $usergroups = Usergroups::model()->findAll($criteria);
            } */  
    		//$this->loadModel($id)->delete();
            $user = User::model()->find('id=:id', array(':id'=>$id));
            
            if($role_update==5){
                //guidedata
                $guidedata = SegGuidesdata::model()->find('idseg_guidesdata=:idseg_guidesdata', array(':idseg_guidesdata'=>$user->id_guide));
                if(isset($guidedata)){$guidedata->delete();}
                
                //guide-town
                $guidetown = SegGuidesCities::model()->find('users_id=:users_id', array(':users_id'=>$id));
                if(isset($guidetown)){$guidetown->delete();}
                
                //guide-languages
                $guidetours = SegGuidesTourroutes::model()->findAll('usersid=:usersid', array(':usersid'=>$id));
                if(isset($guidetours)){
                    foreach($guidetours as $guidetour){
                        $guidetour->delete();
                    }
                }
                //guide-tours
                $guidelanguages = SegLanguagesGuides::model()->findAll('users_id=:users_id', array(':users_id'=>$id));
                if(isset($guidelanguages)){ 
                    foreach($guidelanguages as $guidelanguage){
                        $guidelanguage->delete();
                    }
                }
            }
    
            $criteria_contact=new CDbCriteria;
            $criteria_contact->condition='idcontacts=:idcontacts';
            $criteria_contact->params=array(':idcontacts'=>$user->id_contact);
            $contact = SegContacts::model()->find($criteria_contact);
            $contact->delete();
            
            //if($user->username!="root"){
 			$this->loadModel($id)->delete();
    		//}
    
    		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    		if(!isset($_GET['ajax']))
    			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                
        }else{
            $this->redirect(array('main/system'));
        }
	}


    
	public function actionAdmin()
	{
	    $id_control = Yii::app()->user->id;
        $role_control = $this->loadModel($id_control)->id_usergroups;        
        if($role_control==1){
            $this->layout = "root";
    		$model=new User('search_root');
            $criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1';
            $criteria->params=array(':groupname1'=>'root');
            $usergroups = Usergroups::model()->findAll($criteria);
            //$modelsearch = $model->search_root();
        }        
        if($role_control==2){
            $this->layout = "admin";
    		$model=new User('search_admin');
            $criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2';
            $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin');
            $usergroups = Usergroups::model()->findAll($criteria);
            //$modelsearch = $model->search_admin();
        }   
        if($role_control==3){
            $this->layout = "office";
    		$model=new User('search_office');
            $criteria=new CDbCriteria;
            $criteria->condition='groupname<>:groupname1 AND groupname<>:groupname2 AND groupname<>:groupname3';
            $criteria->params=array(':groupname1'=>'root',':groupname2'=>'admin',':groupname3'=>'office');
            $usergroups = Usergroups::model()->findAll($criteria);
           // $modelsearch = $model->search_office();
        }       
        
		$model->unsetAttributes();  // clear any default values
    	if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		$this->render('admin',array(
			'model'=>$model,'role_control'=>$role_control,'usergroups'=>$usergroups
		));
	}


/*	public function actionList_root()
	{
        $this->layout = "root";
		$model=new User('search_root');
		$model->unsetAttributes();  // clear any default values
    	if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		$this->render('list_root',array(
			'model'=>$model,
		));
	}
    
	public function actionList_admin()
	{
        $this->layout = "admin";
		$model=new User('search_admin');
		$model->unsetAttributes();  // clear any default values
    	if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		$this->render('list_admin',array(
			'model'=>$model,
		));
	}

	public function actionList_office()
	{
        $this->layout = "office";
		$model=new User('search_office');
		$model->unsetAttributes();  // clear any default values
    	if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		$this->render('list_office',array(
			'model'=>$model,
		));
	}*/

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
