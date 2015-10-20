<?php
class MunichController extends Controller
{
    public function accessRules()
	{
		return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
	       		'users'=>array('*'),  
            
			),
		    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
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
    
	public function actionIndex()
	{
	    $this->layout = "munich";
        
        $cookie_city=Yii::app()->request->cookies['city_munich'];
        $city=$cookie_city->value;
        
       // print_r($city);
        
        $cookie_date=Yii::app()->request->cookies['date_munich'];
        $date=$cookie_date->value;
        
	    if(($city=='')or(isset($city)))$city=2;
        if(($date=='Date')or($date=='')or(isset($date)))$date =date('d.m.Y');
        $date_format = strtotime($date);
        
        //city
        $town = SegCities::model()->findByPk($city);
        $criteria = new CDbCriteria;
        $criteria->condition = 'city_id=:city_id AND date_now=:date_now';
        $criteria->params = array(':city_id' => $town->idseg_cities,':date_now'=>$date_format);
        $scheduleds = SegScheduledTours::model()->findAll($criteria);
       
        //tours
        $criteria_tour = new CDbCriteria;
        $criteria_tour->condition = 'cityid=:cityid';
        $criteria_tour->params = array(':cityid' => $town->idseg_cities);
        $tours = SegTourroutes::model()->findAll($criteria_tour);

        $scheduled_array_y = array();$i=0;$j=0;
        foreach($tours as $tour){
                if(isset($scheduleds)){
                    foreach($scheduleds as $scheduled){
                        if(($scheduled->tourroute_id == $tour->idseg_tourroutes)or($scheduled->tourroute_id == NULL)){
                            
                            // language ob
                            $criteria_lanl = new CDbCriteria;
                            $criteria_lanl->condition = 'users_id=:users_id';
                            $criteria_lanl->params = array(':users_id' => $scheduled->guide1_id);
                            $language_link = SegLanguagesGuides::model()->findAll($criteria_lanl);
       
                            $language_array=array();$z=0;
                            foreach($language_link as $item_language_ob){
                                $criteria_lan = new CDbCriteria;
                                $criteria_lan->condition = 'id_languages=:id_languages';
                                $criteria_lan->params = array(':id_languages' => $item_language_ob->languages_id);
                                $language_array[$z] = Languages::model()->find($criteria_lan);
                                $z++;
                            }
                                
                            $scheduled->language_id_all = $language_array;
                            
                            $scheduled_array_y[$i] = $scheduled;
                            $i++;
                        }
                    }
                    $i=0;
                }
                $scheduled_array[$j]= $scheduled_array_y;$j++;
        }
	    $this->render('index',array('city'=>$town->seg_cityname,'date'=>$date,'tours'=>$tours, 'scheduled_array'=>$scheduled_array));
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}