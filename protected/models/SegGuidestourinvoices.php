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
 */
class SegGuidestourinvoices extends CActiveRecord
{
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
		//	array('creationDate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idseg_guidesTourInvoices, creationDate, cityid, sched_tourid, guideNr, overAllIncome, cashIncome, InvoiceNumber, TA_string', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_guidesTourInvoices' => 'Idseg Guides Tour Invoices',
			'creationDate' => 'Creation Date',
			'cityid' => 'Cityid',
			'sched_tourid' => 'Sched Tourid',
			'guideNr' => 'Guide Nr',
			'overAllIncome' => 'Over All Income',
			'cashIncome' => 'Cash Income',
			'InvoiceNumber' => 'Invoice Number',
			'TA_string' => 'Ta String',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idseg_guidesTourInvoices',$this->idseg_guidesTourInvoices);
		$criteria->compare('creationDate',$this->creationDate,true);
		$criteria->compare('cityid',$this->cityid);
		$criteria->compare('sched_tourid',$this->sched_tourid);
		$criteria->compare('guideNr',$this->guideNr);
		$criteria->compare('overAllIncome',$this->overAllIncome);
		$criteria->compare('cashIncome',$this->cashIncome);
		$criteria->compare('InvoiceNumber',$this->InvoiceNumber);
		$criteria->compare('TA_string',$this->TA_string,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
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
