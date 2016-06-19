<?php

class DopMenuFilter extends CWidget
{
	public $city;	
	public $date_n;	
	public $time_n;	
	public $language;	
	public $guide;	
	
	
	
		
   	public function run()
   	{
	   
	   $model = new Filter;
	   $model->city = $this->city;
	   $model->date_n = $this->date_n;
	   $model->time_n = $this->time_n;
	   $model->language = $this->language;
	   $model->guide = $this->guide;
	   
	   /*CITY*/
	   $citys = SegCities::model()->findAll();	
	   
	   /*TIME*/ 
	   $times = SegStarttimes::model()->findAll();	
	   
	   /*LANGUAGE*/
	   $languages = Languages::model()->findAll();	
	   
	   /*GUIDE*/
	   $criteria = new CDbCriteria;
       $criteria->condition = 'cities_id=:cities_id';
       $criteria->params = array(':cities_id' => $this->city);
	   
	   //$criteria->join = 'LEFT JOIN `users` ON (`users`.`id` = `t`.`users_id`)';
	   
	  
	   $guides_link = SegGuidesCities::model()->findAll($criteria);	
	   $guides = array();$i=0;
	   foreach($guides_link as $item){
		      $criteria_1 = new CDbCriteria;
			  $criteria_1->condition = 'id=:id';
			  $criteria_1->params = array(':id' => $item->users_id);
			  $guides_contact = User::model()->find($criteria_1);	

			 // print_r($guides_contact);

			  $criteria_2 = new CDbCriteria;
			  $criteria_2->condition = 'idcontacts=:idcontacts';
			  $criteria_2->params = array(':idcontacts' => $guides_contact->id_contact);
			  $guides[$i]= SegContacts::model()->find($criteria_2);	
			  $i++;
	   }
	   
             
        $this->render('dopMenuFilter', array(
            'citys' => $citys,
			'times' => $times,
			'languages' => $languages,
			'guides' => $guides,
			'model' => $model,
        ));
    }
}