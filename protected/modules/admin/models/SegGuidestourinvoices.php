<?php

/**
 * This is the model class for table "seg_guidestourinvoices".
 *
 * The followings are the available columns in table 'seg_guidestourinvoices':
 * @property integer $idseg_guidesTourInvoices
 * @property string $creationDate
 * @property integer $cityid
 * @property integer $sched_tourid
 * @property integer $guideNr
 * @property double $overAllIncome
 * @property double $cashIncome
 * @property integer $InvoiceNumber
 * @property string $TA_string
* @property string $info
 */
class SegGuidestourinvoices extends CActiveRecord
{
 	public $from_date;
	public $to_date;
	private $_cli = null;
	private $_time = null;
	private $_ph = null;
	private $_em = null;
	private $_dep = null;
	private $_use = null;
	private $_tas = null;
	private $_csl = null;
	private $_city = null;
	private $_fname = null;
	private $_sname = null;
	private $_sum = 0;

	public function getLangname(){
		if ($this->_use === null && $this->sched !== null && $this->sched->language_ob !== null)
		{
			$this->_use = $this->sched->language_ob->germanname;
		}
		return $this->_use;
	}
	public function setLangname($value){
		$this->_use = $value;
	}
	public function getCityname(){
		if ($this->_city === null && $this->sched !== null && $this->sched->city_ob !== null)
		{
			$this->_city = $this->sched->city_ob->seg_cityname;
		}
		return $this->_city;
	}
	public function setCityname($value){
		$this->_city = $value;
	}
	public function getTrname(){
		if ($this->_dep === null && $this->sched !== null && $this->sched->tourroute_ob !== null)
		{
			$this->_dep = $this->sched->tourroute_ob->tour_categories->name;
		}
		return $this->_dep;
	}
	public function setTrname($value){
		$this->_dep = $value;
	}
	public function getStime(){
		if ($this->_time === null && $this->sched !== null)
		{
			$this->_time =Yii::app()->dateFormatter->format('HH:mm',strtotime($this->sched->starttime)) ;
//			$this->_time = $this->sched->starttime;
		}
		return $this->_time;
	}
	public function setStime($value){
		$this->_time = $value;
	}
	public function getCancel(){
		if ($this->_csl === null && $this->sched !== null)
		{
			$this->_csl = $this->sched->isCanceled;
		}
		return $this->_csl;
	}
	public function setCancel($value){
		$this->_csl = $value;
	}
	public function getGuidename(){
		if ($this->_cli === null && $this->sched !== null && $this->sched->user_ob !== null)
		{
			$this->_cli = $this->sched->user_ob->username;
		}
		return $this->_cli;
	}
	public function setGuidename($value){
		$this->_cli = $value;
	}	    
	public function getCustname(){
		if ($this->_fname === null && $this->contact !== null)
		{
			if(count($this->contact)>0)
			$this->_fname = $this->contact->firstname;
		}
		return $this->_fname;
	}
	public function setCustname($value){
		$this->_fname = $value;
	}
	public function getPhone(){
		if ($this->_ph === null && $this->contact !== null)
		{
			$this->_ph = $this->contact->phone;
		}
		return $this->_ph;
	}
	public function setPhone($value){
		$this->_ph = $value;
	}
	public function getEmail(){
		if ($this->_em === null && $this->contact !== null)
		{
			$this->_em = $this->contact->email;
		}
		return $this->_em;
	}
	public function setEmail($value){
		$this->_em = $value;
	}
	public function getCustsname(){
		if ($this->_sname === null && $this->contact !== null)
		{
			if(count($this->contact)>0)
			$this->_sname = $this->contact->surname;
		}
		return $this->_sname;
	}
	public function setCustsname($value){
		$this->_sname = $value;
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seg_guidestourinvoices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('cityid, sched_tourid, guideNr, InvoiceNumber', 'numerical', 'integerOnly'=>true),
		//	array('overAllIncome, cashIncome', 'numerical'),
		//	array('TA_string', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('creationDate,info, from_date, to_date, sched, countCustomers, custname, custsname, idseg_guidesTourInvoices, creationDate, cityid, sched_tourid, guideNr, overAllIncome, cashIncome, InvoiceNumber, TA_string, contacts_id, cityname, langname, guidename, phone, email, trname, stime, cancel', 'safe', 'on'=>'search'),
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
			'guidestourinvoicescustomers'=>array(self::HAS_MANY, 'SegGuidestourinvoicescustomers', 'tourInvoiceid'),
			'contact'=>array(self::BELONGS_TO, 'SegContacts', 'contacts_id'),
			'sched'=>array(self::BELONGS_TO, 'SegScheduledTours', 'id_sched'),
            'countCustomers'=>array(self::STAT, 'SegGuidestourinvoicescustomers', 'tourInvoiceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_guidesTourInvoices' => 'ID',
			'creationDate' => 'Creation Date',
			'cityid' => 'Cityid',
			'sched_tourid' => 'Sched Tourid',
			'guideNr' => 'Guide Nr',
			'overAllIncome' => 'Over All Income',
			'countCustomers' => 'Gäste',
			'cashIncome' => 'Cash Income',
			'InvoiceNumber' => 'Invoice Number',
			'TA_string' => 'Rechnung',
			'from_date' => 'Von:',
			'to_date' => 'Bis:',
			'custname' => 'Vorname',
			'custsname' => 'Nachname',
			'info' => 'Info',
		);
	}
		private function daterange($criteria)
	{
        $txtd='sched.date';
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
    	$sort   = new CSort;
	    $criteria->with = array('sched'=>array('with'=>array('language_ob','tourroute_ob'=>array('with'=>'tour_categories'),'city_ob','user_ob')),'contact','countCustomers');

		$criteria->compare('idseg_guidesTourInvoices',$this->idseg_guidesTourInvoices);
		$criteria->compare('creationDate',$this->creationDate,true);
		$criteria->compare('cityid',$this->cityid);
		$criteria->compare('sched_tourid',$this->sched_tourid);
		$criteria->compare('guideNr',$this->guideNr);
		$criteria->compare('info',$this->info);
		$criteria->compare('overAllIncome',$this->overAllIncome);
		$criteria->compare('cashIncome',$this->cashIncome);
		$criteria->compare('InvoiceNumber',$this->InvoiceNumber);
		$criteria->compare('TA_string',$this->TA_string,true);
		$criteria->compare('sched.starttime',$this->stime,true);
		$criteria->compare('sched.isCanceled',$this->cancel,true);
		$criteria->compare('contact.firstname',$this->custname,true);
		$criteria->compare('contact.email',$this->email,true);
		$criteria->compare('contact.phone',$this->phone,true);
		$criteria->compare('contact.surname',$this->custsname,true);
//		$criteria->compare('city_ob.seg_cityname',$this->cityname,true);
		$criteria->compare('t.cityid',$this->cityname,true);
//		$criteria->compare('tour_categories.name',$this->trname,true);
		$criteria->compare('tour_categories.id_tour_categories',$this->trname,true);
//		$criteria->compare('language_ob.germanname',$this->langname,true);
		$criteria->compare('sched.language_id',$this->langname,true);
		$criteria->compare('user_ob.username',$this->guidename,true);
		$this->daterange($criteria);
		$sort->attributes = array(
			'*',
			'cancel'=>array('asc'=>'sched.isCanceled',
							'desc'=>'sched.isCanceled DESC', 
							'label'=>'Absagen'),
			'stime'=>array('asc'=>'sched.starttime',
							'desc'=>'sched.starttime DESC', 
							'label'=>'Uhrzeit'),
			'phone'=>array('asc'=>'contact.phone',
							'desc'=>'contact.phone DESC', 
							'label'=>'Telefon'),
		'trname'=>array('asc'=>'tour_categories.name',
							'desc'=>'tour_categories.name DESC', 
							'label'=>'Tour'),
//							'label'=>'Tour route'),
			'email'=>array('asc'=>'contact.email',
							'desc'=>'contact.email DESC', 
							'label'=>'Email'),
			'custname'=>array('asc'=>'contact.firstname',
							'desc'=>'contact.firstname DESC', 
							'label'=>'Vorname'),
			'custsname'=>array('asc'=>'contact.surname',
							'desc'=>'contact.surname DESC', 
							'label'=>'Nachname'),
			'cityname'=>array('asc'=>'city_ob.seg_cityname',
					'desc'=>'city_ob.seg_cityname DESC', 
					'label'=>'Stadt'),
			'langname'=>array('asc'=>'language_ob.germanname',
					'desc'=>'language_ob.germanname DESC', 
					'label'=>'Sprachen'),
			'guidename'=>array('asc'=>'user_ob.username',
					'desc'=>'user_ob.username DESC', 
					'label'=>'Guide'),
	/*	'trname'=>'tourroute_ob.name',
			'tastring'=>array('asc'=>'guidestourinvoice.TA_string',
					'desc'=>'guidestourinvoice.TA_string DESC', 
					'label'=>'Invoice #'),
	*/	);
		$sort->defaultOrder= array(
            'sched.date_now'=>CSort::SORT_ASC,
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
	 * @return SegGuidestourinvoices the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
