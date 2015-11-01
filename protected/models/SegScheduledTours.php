<?php

/**
 * This is the model class for table "seg_scheduled_tours".
 *
 * The followings are the available columns in table 'seg_scheduled_tours':
 * @property integer $idseg_scheduled_tours
 * @property integer $tourroute_id
 * @property integer $openTour
 * @property integer $TNmax_sched
 * @property integer $duration
 * @property string $starttime
 * @property string $date
 * @property integer $current_subscribers
 * @property integer $language_id
 * @property integer $guide1_id
 * @property integer $guide2_id
 * @property integer $guide3_id
 * @property integer $guide4_id
 * @property string $original_starttime
 * @property string $additional_info
 * @property integer $visibility
 * @property integer $city_id
 * @property integer $isInvoiced_guide1
 * @property integer $isInvoiced_guide2
 * @property integer $isInvoiced_guide3
 * @property integer $isInvoiced_guide4
 * @property string $additional_info2
 * @property integer $isCanceled
 * @property string $cancellationReason
 * @property integer $canceledBy
 * @property string $cancellationAnnotation
 */

class SegScheduledTours extends CActiveRecord
{
    public $tourroute_id_all = array();
   // public $TNmax_sched_all;
  //  public $duration_all;
    public $language_id_all = array();
    public $city_id_all='';

	public $date_time;
	public $tour_i;
	    
	public function tableName()
	{
		return 'seg_scheduled_tours';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tourroute_id, openTour, TNmax_sched, duration, current_subscribers, language_id, guide1_id, guide2_id, guide3_id, guide4_id, visibility, city_id, isInvoiced_guide1, isInvoiced_guide2, isInvoiced_guide3, isInvoiced_guide4, isCanceled, canceledBy', 'numerical', 'integerOnly'=>true),
			array('additional_info, additional_info2', 'length', 'max'=>1000),
			array('cancellationReason', 'length', 'max'=>250),
			array('cancellationAnnotation', 'length', 'max'=>1500),
			array('starttime, date, original_starttime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('city_ob, language_ob, tourroute_ob, idseg_scheduled_tours, tourroute_id, openTour, TNmax_sched, duration, starttime, date, current_subscribers, language_id, guide1_id, guide2_id, guide3_id, guide4_id, original_starttime, additional_info, visibility, city_id, isInvoiced_guide1, isInvoiced_guide2, isInvoiced_guide3, isInvoiced_guide4, additional_info2, isCanceled, cancellationReason, canceledBy, cancellationAnnotation', 'safe', 'on'=>'search'),
			
		array('user_ob,city_ob, language_ob, tourroute_ob, idseg_scheduled_tours, tourroute_id, openTour, TNmax_sched, duration, starttime, date, current_subscribers, language_id, guide1_id, guide2_id, guide3_id, guide4_id, original_starttime, additional_info, visibility, city_id, isInvoiced_guide1, isInvoiced_guide2, isInvoiced_guide3, isInvoiced_guide4, additional_info2, isCanceled, cancellationReason, canceledBy, cancellationAnnotation', 'safe', 'on'=>'search_s'),
	
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'city_ob'=>array(self::BELONGS_TO, 'SegCities', 'city_id'),
            'language_ob'=>array(self::BELONGS_TO, 'Languages', 'language_id'),
            'tourroute_ob'=>array(self::BELONGS_TO, 'SegTourroutes', 'tourroute_id'),
            'user_ob'=>array(self::BELONGS_TO, 'User', 'guide1_id'),

 			//'tourroute_all'=>array(self::HAS_MANY, 'SegGuidesTourroutes', array('usersid'=>'guide1_id')),
			'language_all'=>array(self::HAS_MANY, 'SegLanguagesGuides', array('users_id'=>'guide1_id')),
			'bookings'=>array(self::HAS_MANY, 'SegBookings', 'sched_tourid'),
			'guidestourinvoices'=>array(self::HAS_MANY, 'SegGuidestourinvoices', 'id_sched'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_scheduled_tours' => 'ID',
			'tourroute_id' => 'Tour',
			'openTour' => 'Open Tour',
			'TNmax_sched' => 'Tnmax Sched',
			'duration' => 'Duration (minutes)',
			'starttime' => 'Time',
			'date_now' => 'Date',
			'current_subscribers' => 'Gueste',//'Current Subscribers',
			'language_id' => 'ID Language',
			'language_ob' => 'Language',
			'guide1_id' => 'Guide',
            'user_ob' => 'User',
			'guide2_id' => 'Guide2',
			'guide3_id' => 'Guide3',
			'guide4_id' => 'Guide4',
			'original_starttime' => 'Original Starttime',
			'additional_info' => 'Additional Info',
			'visibility' => 'On/Off',
			'city_id' => 'City',
			'isInvoiced_guide1' => 'Is Invoiced Guide1',
			'isInvoiced_guide2' => 'Is Invoiced Guide2',
			'isInvoiced_guide3' => 'Is Invoiced Guide3',
			'isInvoiced_guide4' => 'Is Invoiced Guide4',
			'additional_info2' => 'Additional Info2',
			'isCanceled' => 'Is Canceled',
			'cancellationReason' => 'Cancellation Reason',
			'canceledBy' => 'Canceled By',
			'cancellationAnnotation' => 'Cancellation Annotation',
            'tourroute_ob' =>'Tour route',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search_people($id_control)
	{
		$criteria_scheduled = new CDbCriteria;
		$criteria_scheduled->order = 'date_now DESC';
 	    $criteria_scheduled->condition = 'guide1_id=:guide1_id AND TNmax_sched>:TNmax_sched';
        $criteria_scheduled->params = array(':guide1_id' =>$id_control,':TNmax_sched' => 0);

  		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria_scheduled,
			 'sort'=>array(
                'attributes'=>array( 
                ),
                'defaultOrder'=>'starttime',
            )
		));
	}
	 
	 
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

 		$criteria->order = 'date_now DESC';
        $criteria->with = array('user_ob','city_ob','language_ob','tourroute_ob');
        $criteria->compare('user_ob.id',$this->user_ob,true);
		$criteria->compare('city_ob.city_id',$this->city_ob,true);
		$criteria->compare('language_ob.language_id',$this->language_ob,true);
        $criteria->compare('tourroute_ob.tourroute_id',$this->tourroute_ob,true);


		$criteria->compare('idseg_scheduled_tours',$this->idseg_scheduled_tours);
		$criteria->compare('tourroute_id',$this->tourroute_id);
		$criteria->compare('openTour',$this->openTour);
		$criteria->compare('TNmax_sched',$this->TNmax_sched);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('starttime',$this->starttime,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('current_subscribers',$this->current_subscribers);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('guide1_id',$this->guide1_id);
		$criteria->compare('guide2_id',$this->guide2_id);
		$criteria->compare('guide3_id',$this->guide3_id);
		$criteria->compare('guide4_id',$this->guide4_id);
		$criteria->compare('original_starttime',$this->original_starttime,true);
		$criteria->compare('additional_info',$this->additional_info,true);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('isInvoiced_guide1',$this->isInvoiced_guide1);
		$criteria->compare('isInvoiced_guide2',$this->isInvoiced_guide2);
		$criteria->compare('isInvoiced_guide3',$this->isInvoiced_guide3);
		$criteria->compare('isInvoiced_guide4',$this->isInvoiced_guide4);
		$criteria->compare('additional_info2',$this->additional_info2,true);
		$criteria->compare('isCanceled',$this->isCanceled);
		$criteria->compare('cancellationReason',$this->cancellationReason,true);
		$criteria->compare('canceledBy',$this->canceledBy);
		$criteria->compare('cancellationAnnotation',$this->cancellationAnnotation,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search_s($guide1_id, $date=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
        
       

        $criteria->condition = 'guide1_id=:guide1_id';
         $criteria->params = array(':guide1_id' => $guide1_id);
		 if(!is_null($date)){
		$criteria->addCondition("t.date  <= '$date'");
		 }
        $criteria->order = 'date_now DESC, starttime DESC';
        
         $criteria->with = array('city_ob','language_ob','tourroute_ob');
		$criteria->compare('city_ob.city_id',$this->city_ob,true);
		$criteria->compare('language_ob.language_id',$this->language_ob,true);
        $criteria->compare('tourroute_ob.tourroute_id',$this->tourroute_ob,true);
        	$criteria->compare('idseg_scheduled_tours',$this->idseg_scheduled_tours);
		$criteria->compare('tourroute_id',$this->tourroute_id);
		$criteria->compare('openTour',$this->openTour);
		$criteria->compare('TNmax_sched',$this->TNmax_sched);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('starttime',$this->starttime);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('current_subscribers',$this->current_subscribers);
		$criteria->compare('language_id',$this->language_id);
		$criteria->compare('guide1_id',$this->guide1_id);
		$criteria->compare('guide2_id',$this->guide2_id);
		$criteria->compare('guide3_id',$this->guide3_id);
		$criteria->compare('guide4_id',$this->guide4_id);
		$criteria->compare('original_starttime',$this->original_starttime,true);
		$criteria->compare('additional_info',$this->additional_info,true);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('isInvoiced_guide1',$this->isInvoiced_guide1);
		$criteria->compare('isInvoiced_guide2',$this->isInvoiced_guide2);
		$criteria->compare('isInvoiced_guide3',$this->isInvoiced_guide3);
		$criteria->compare('isInvoiced_guide4',$this->isInvoiced_guide4);
		$criteria->compare('additional_info2',$this->additional_info2,true);
		$criteria->compare('isCanceled',$this->isCanceled);
		$criteria->compare('cancellationReason',$this->cancellationReason,true);
		$criteria->compare('canceledBy',$this->canceledBy);
		$criteria->compare('cancellationAnnotation',$this->cancellationAnnotation,true);
       	
           return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
 			   'pagination'=>array(
        'pageSize'=>30,
    ),
  		));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegScheduledTours the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    // Для преобразования (если необходимо)
/*protected function beforeSave() {
   if(parent::beforeSave()) {
       $this->date = date('dd.mm.yy', strtotime($this->date));//strtotime($this->date_start);
       return true;
   } else {
       return false;
   }
}*/
 
// Для преобразования (если необходимо)
/*protected function afterFind() {
   $date = date('d.m.Y', strtotime($this->date));
   $this->date = $date;
   parent::afterFind();
}*/
    
}
