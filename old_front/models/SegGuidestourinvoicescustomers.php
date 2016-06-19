<?php

/**
 * This is the model class for table "seg_guidestourinvoicescustomers".
 *
 * The followings are the available columns in table 'seg_guidestourinvoicescustomers':
 * @property integer $idseg_guidesTourInvoicesCustomers
 * @property integer $tourInvoiceid
 * @property string $customersName
 * @property integer $isTourist
 * @property integer $discounttype_id
 * @property integer $paymentoptionid
 * @property double $price
 * @property integer $CustomerInvoiceNumber
 * @property integer $cityid
 * @property string $KA_string
 * @property integer $isPaid
 * @property integer $origin_booking
 */
class SegGuidestourinvoicescustomers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seg_guidestourinvoicescustomers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('origin_booking', 'required'),
		//	array('tourInvoiceid, isTourist, discounttype_id, paymentoptionid, CustomerInvoiceNumber, cityid, isPaid, origin_booking', 'numerical', 'integerOnly'=>true),
		//	array('price', 'numerical'),
		//	array('customersName', 'length', 'max'=>60),
		//	array('KA_string', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tourInvoiceid, customersName, isTourist, discounttype_id, paymentoptionid, price, CustomerInvoiceNumber, cityid, KA_string, isPaid, origin_booking, id_invoiceoptions', 'safe', 'on'=>'search, update'),
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
//			'booking'=>array(self::BELONGS_TO, 'SegBookings', 'origin_booking'),
			'tourinvoice'=>array(self::BELONGS_TO, 'SegGuidestourinvoices', 'tourInvoiceid'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_guidesTourInvoicesCustomers' => 'Idseg Guides Tour Invoices Customers',
			'tourInvoiceid' => 'Tour Invoiceid',
			'customersName' => 'Customers Name',
			'isTourist' => 'Is Tourist',
			'discounttype_id' => 'Discounttype',
			'paymentoptionid' => 'Paymentoptionid',
			'price' => 'Price',
			'CustomerInvoiceNumber' => 'Customer Invoice Number',
			'cityid' => 'Cityid',
			'KA_string' => 'Ka String',
			'isPaid' => 'Is Paid',
			'origin_booking' => 'Origin Booking',
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

		$criteria->compare('idseg_guidesTourInvoicesCustomers',$this->idseg_guidesTourInvoicesCustomers);
		$criteria->compare('tourInvoiceid',$this->tourInvoiceid);
		$criteria->compare('customersName',$this->customersName,true);
		$criteria->compare('isTourist',$this->isTourist);
		$criteria->compare('discounttype_id',$this->discounttype_id);
		$criteria->compare('paymentoptionid',$this->paymentoptionid);
		$criteria->compare('price',$this->price);
		$criteria->compare('CustomerInvoiceNumber',$this->CustomerInvoiceNumber);
		$criteria->compare('cityid',$this->cityid);
		$criteria->compare('KA_string',$this->KA_string,true);
		$criteria->compare('isPaid',$this->isPaid);
		$criteria->compare('origin_booking',$this->origin_booking);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegGuidestourinvoicescustomers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
