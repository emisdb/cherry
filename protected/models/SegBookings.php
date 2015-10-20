<?php

/**
 * This is the model class for table "seg_bookings".
 *
 * The followings are the available columns in table 'seg_bookings':
 * @property integer $idseg_bookings
 * @property integer $customer_id
 * @property string $customer_annotation
 * @property integer $pay_option_id
 * @property integer $isPrivate
 * @property integer $groupsize
 * @property integer $status
 * @property integer $sched_tourid
 * @property integer $discounttype_id
 * @property integer $plusUSt
 * @property integer $isPaid
 */
class SegBookings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seg_bookings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer_id, pay_option_id, isPrivate, groupsize, status, sched_tourid, discounttype_id, plusUSt, isPaid', 'numerical', 'integerOnly'=>true),
			array('customer_annotation', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sched,contact,idseg_bookings, customer_id, customer_annotation, pay_option_id, isPrivate, groupsize, status, sched_tourid, discounttype_id, plusUSt, isPaid', 'safe', 'on'=>'search'),
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
			'sched'=>array(self::BELONGS_TO, 'SegScheduledTours', 'sched_tourid'),
			'contact'=>array(self::BELONGS_TO, 'SegContacts', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_bookings' => 'Idseg Bookings',
			'customer_id' => 'Customer',
			'customer_annotation' => 'Customer Annotation',
			'pay_option_id' => 'Pay Option',
			'isPrivate' => 'Is Private',
			'groupsize' => 'Groupsize',
			'status' => 'Status',
			'sched_tourid' => 'Sched Tourid',
			'discounttype_id' => 'Discounttype',
			'plusUSt' => 'Plus Ust',
			'isPaid' => 'Is Paid',
			'sched'=> 'Sched',
			'contact' => 'Contact',
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

		$criteria->compare('idseg_bookings',$this->idseg_bookings);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('customer_annotation',$this->customer_annotation,true);
		$criteria->compare('pay_option_id',$this->pay_option_id);
		$criteria->compare('isPrivate',$this->isPrivate);
		$criteria->compare('groupsize',$this->groupsize);
		$criteria->compare('status',$this->status);
		$criteria->compare('sched_tourid',$this->sched_tourid);
		$criteria->compare('discounttype_id',$this->discounttype_id);
		$criteria->compare('plusUSt',$this->plusUSt);
		$criteria->compare('isPaid',$this->isPaid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegBookings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
