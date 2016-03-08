<?php

/**
 * This is the model class for table "cashbox_change_requests".
 *
 * The followings are the available columns in table 'cashbox_change_requests':
 * @property integer $idcashbox_change_requests
 * @property integer $id_users
 * @property integer $id_type
 * @property double $delta_cash
 * @property string $reason
 * @property integer $approvedBy
 * @property string $request_date
 * @property string $approval_date
 * @property string $sched_user_id
 * 
 * 
 */
class CashboxChangeRequests extends CActiveRecord
{
    public $image; 
	public $from_date;
	public $to_date;
	private $_cli = null;
	private $_ct = null;
	private $_city = null;
	private $_tstr = null;
	public function getCityname(){
		if ($this->_city === null && $this->user !== null)
		{
			$this->_city = $this->user->cityname;
		}

		return $this->_city;
	}
	public function setCityname($value){

			$this->_city = $value;
	}
	public function getGuidename(){
		if ($this->_cli === null && $this->user !== null)
		{
			$this->_cli = $this->user->username;
		}
		return $this->_cli;
	}
	public function setGuidename($value){
		$this->_cli = $value;
	}
	public function getTtastring(){
		if($this->id_type<3){
		if ($this->_tstr === null && $this->sched !== null)
			{
//				$this->_tstr = $this->sched->tastring;
				$this->_tstr = $this->sched->guidestourinvoice->TA_string;
			}
		
		}
		return $this->_tstr;
	}
	public function setTtastring($value){
		if($this->id_type<3){
		$this->_tstr = $value;
		}
	}
	public function getTypename(){
		if ($this->_ct === null && $this->cashtype !== null)
		{
			$this->_ct = $this->cashtype->name;
		}
		return $this->_ct;
	}
	public function setTypename($value){
		$this->_ct = $value;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cashbox_change_requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_users, id_type, delta_cash', 'required'),
			array('id_users, id_type, approvedBy', 'numerical', 'integerOnly'=>true),
			array('delta_cash', 'numerical'),
//			array('id_type', 'checktype'),
			array('reason', 'length', 'max'=>255),
			array('approval_date,id_users,id_type,delta_cash,approvedBy,reason,sched_user_id,image, from_date, to_date, guidename, cityname', 'safe'),
			array('image', 'file', 'maxSize'=>10*1024*1024, 'allowEmpty'=>true, 'safe'=>false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcashbox_change_requests, id_users, id_type, delta_cash, sched ,reason, approvedBy, request_date, approval_date, typename', 'safe', 'on'=>'search'),
			array('idcashbox_change_requests, id_users, id_type, delta_cash, sched ,reason, approvedBy, request_date, approval_date, guidename, cityname,ttastring, typename', 'safe', 'on'=>'search_full'),
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
			'user' => array(self::BELONGS_TO, 'User', 'id_users'),	
			'apuser' => array(self::BELONGS_TO, 'User', 'approvedBy'),	
			'cashtype' => array(self::BELONGS_TO, 'CashboxType', 'id_type'),	
			'sched'=>array(self::BELONGS_TO, 'SegScheduledTours', 'sched_user_id','with'=>'guidestourinvoice'),
 //      		'schedo'=>array(self::BELONGS_TO, 'SegScheduledTours', 'sched_user_id','with'=>'city_ob'),
       		'schedo'=>array(self::BELONGS_TO, 'SegScheduledTours', 'sched_user_id','with'=>'city_ob', 'on'=>'id_type in (1,2)'),
			'tuser'=>array(self::BELONGS_TO, 'User', 'sched_user_id','with'=>'contact_ob', 'on'=>'id_type=3'),
       		'doc' => array(self::HAS_ONE, 'CashboxChangeRequestDocuments', 'cashbox_change_requestid'),
				);
	}

	protected function beforeValidate()
    {
		if(in_array($this->id_type, [1,2])) {
			if(is_null($this->sched_user_id)||empty($this->sched_user_id)){
				$this->addError ('id_type', 'The tour number must be set for this cashbox type');
				return false;
			}
			else{
				if(is_null(SegScheduledTours::model()->find('idseg_scheduled_tours='.$this->sched_user_id)))
				{
						$this->addError('id_type', 'Scheduled tour with this number is not found');
					return false;
				}
			}
		}
		if(in_array($this->id_type, [3])) {
			if(is_null($this->sched_user_id)||empty($this->sched_user_id)){
				$this->addError ('id_type', 'The other user must be specified for this cashbox type:'.$this->sched_user_id);
				return false;
			}
			else{
//				if(is_null(User::model()->find('id=:idseg_scheduled_tours'),array(':idseg_scheduled_tours'=>$this->sched_user_id)))
				if(is_null(User::model()->find('id='.$this->sched_user_id)))
				{
						$this->addError('id_type', 'The user with this number is not found');
				return false;
				}
			}
		}
			 return parent::beforeValidate();
	
	}
    		public function behaviors()
		{
			return array(
			'CTimestampBehavior' => array(
			'class' => 'zii.behaviors.CTimestampBehavior',
			'createAttribute' => 'request_date',
			'updateAttribute' =>null,
			),
			);
		}
	/**
	 * @return array relational rules.
	 */
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcashbox_change_requests' => 'ID',
			'id_users' => 'Id Users',
			'ttastring' => 'Rechnung',
			'image' => 'Upload document',
            'sched' => 'Rechnun',
			'id_type' => 'Vorgang',
//			'delta_cash' => 'Ka&szlig;eänderung',
			'delta_cash' => 'Kasseänderung',
			'guidename' => 'Guide',
			'typename' => 'Vorgang',
			'cityname' => 'City',
			'reason' => 'Begründung',
			'approvedBy' => 'Genehmigung durch',
			'request_date' => 'Datum',
			'approval_date' => 'Genehmigungsdatum',
			'sched_user_id' => 'Guide',
			'from_date' => 'Von:',
			'to_date' => 'Bis:',
			
		);
	}
             	    
// 	   Begründung     Link     Kasseänderung 
           	      

		public function getUserOptions()
		{
			$usersArray = CHtml::listData(User::model()->with('contact_ob')->findAll('id_guide>0'), 'id', 'contact_ob.firstname');
			return $usersArray;
		}
		public function getTotals($ids)
        {
                $ids = implode(",",$ids);
               if(strlen($ids)==0)  return Yii::app()->numberFormatter->formatCurrency(0,'');
                
                $connection=Yii::app()->db;
                 $command=$connection->createCommand("SELECT SUM(delta_cash)
                                                     FROM `".$this->tableName()."` where idcashbox_change_requests in (".$ids.")");

                 return Yii::app()->numberFormatter->formatCurrency($command->queryScalar(),'');
        }

		private function daterange($criteria)
	{
        $txtd='t.request_date';
 		if(!empty($this->from_date) && empty($this->to_date))
            {
                $criteria->addCondition($txtd." >= '".date('Y-m-d H:i:s', strtotime($this->from_date))."'");  
                            // date is database date column field
            }
                    elseif(!empty($this->to_date) && empty($this->from_date))
            {
                $criteria->addCondition($txtd." <= '".date('Y-m-d H:i:s', strtotime($this->to_date." 23:59:59"))."'");
            }
                    elseif(!empty($this->to_date) && !empty($this->from_date))
            {
                $criteria->addCondition($txtd."  >= '".date('Y-m-d H:i:s', strtotime($this->from_date))."' and ".$txtd." <= '".date('Y-m-d H:i:s', strtotime($this->to_date." 23:59:59"))."'");
            }
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
	public function search($guide=0)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sort   = new CSort;
        $criteria->with = array("sched"=>array("with"=>"guidestourinvoice"),"apuser","user","tuser","cashtype","doc");
		$criteria->compare('idcashbox_change_requests',$this->idcashbox_change_requests);
		$criteria->compare('id_users',$this->id_users);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('delta_cash',$this->delta_cash);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('approvedBy',$this->approvedBy);
		$criteria->compare('request_date',$this->request_date,true);
		$criteria->compare('approval_date',$this->approval_date,true);
		if($guide>0)
			$criteria->addInCondition ("id_type", array(3,4));
		$this->daterange($criteria);
		$sort->defaultOrder= array(
            'request_date'=>CSort::SORT_DESC,
        );
		return new CActiveDataProvider($this, array(
          'pagination'=>false,
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}
	public function search_full()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$sort   = new CSort;
        $criteria->with = array("apuser","user"=>array("with"=>array("city"=>array("with"=>"cities"))),"cashtype","doc","sched"=>array("with"=>"guidestourinvoice"));
//        $criteria->with = array("schedo"=>array("with"=>"city_ob"),"apuser","user","cashtype","doc");
//        $criteria->with = array("schedo"=>array("with"=>"city_ob"),"apuser","user","cashtype","doc");
		$criteria->compare('idcashbox_change_requests',$this->idcashbox_change_requests);
		$criteria->compare('id_users',$this->id_users);
		$criteria->compare('user.username',$this->guidename,true);
		$criteria->compare('cashtype.name',$this->typename,true);
		$criteria->compare('guidestourinvoice.TA_string',$this->ttastring,true);
//		$criteria->compare('sched.tastring',$this->ttastring,true);
		$criteria->compare('cities.seg_cityname',$this->cityname,true);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('delta_cash',$this->delta_cash);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('approvedBy',$this->approvedBy);
		$criteria->compare('request_date',$this->request_date,true);
		$criteria->compare('approval_date',$this->approval_date,true);
		$this->daterange($criteria);
		$sort->defaultOrder= array(
            'request_date'=>CSort::SORT_DESC,
        );
		$sort->attributes = array(
			'*',
			'cityname'=>array('asc'=>'cities.seg_cityname',
							'desc'=>'cities.seg_cityname DESC', 
							'label'=>'Stadt'),
//			'cityname'=>array('asc'=>'city_ob.seg_cityname',
//							'desc'=>'city_ob.seg_cityname DESC', 
//							'label'=>'City'),
			'guidename'=>array('asc'=>'user.username',
							'desc'=>'user.username DESC', 
							'label'=>'Guide'),
			'ttastring'=>array('asc'=>'guidestourinvoice.TA_string',
							'desc'=>'guidestourinvoice.TA_string DESC', 
							'label'=>'Rechnung'),
			'typename'=>array('asc'=>'cashtype.name',
							'desc'=>'cashtype.name DESC', 
							'label'=>'Vorgang'),

		);
		return new CActiveDataProvider($this, array(
          'pagination'=>false,
            'criteria'=>$criteria,
            'sort'=>$sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CashboxChangeRequests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
