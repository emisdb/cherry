<?php

/**
 * This is the model class for table "{{current_subscribers}}".
 *
 * The followings are the available columns in table '{{current_subscribers}}':
 * @property integer $id
 * @property integer $id_contact
 * @property integer $tourist
 * @property integer $id_rabatt
 * @property integer $id_payoption
 * @property integer $price
 * @property integer $vat
 * @property string $note
 * @property integer $id_guide
 * @property integer $id_tour
 * @property integer $id_report
 * @property integer $date_zakaz
 * @property integer $date_report
 */
class CurrentSubscribers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{current_subscribers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('id_contact, tourist, id_rabatt, id_payoption, price, vat, note, id_guide, id_tour, id_report, date_zakaz, date_report', 'required'),
			array('id_contact, id_rabatt, id_payoption, price, vat, id_guide, id_tour, id_scheduled,id_report, date_zakaz, date_report', 'numerical', 'integerOnly'=>true),
			array('note', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_contact, id_rabatt, id_payoption, price, vat, note, id_guide, id_tour, id_scheduled, id_report, date_zakaz, date_report', 'safe', 'on'=>'search'),
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
			 'contact'=>array(self::BELONGS_TO, 'SegContacts', 'id_contact'),
			 'rabatt'=>array(self::BELONGS_TO, 'Bonus', 'id_rabatt'),
			 'payoption'=>array(self::BELONGS_TO, 'Payoptions', 'id_payoption'),
			// 'guide'=>array(self::BELONGS_TO, 'Pay', 'id_guide'),
			 'tour'=>array(self::BELONGS_TO, 'SegTourroutes', 'id_tour'),
			 'scheduled'=>array(self::BELONGS_TO, 'SegScheduledTours', 'id_scheduled'),
			// 'report'=>array(self::BELONGS_TO, 'Pay', 'id_report'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_contact' => 'Id Contact',
			'contact' => 'Contact',
			'id_rabatt' => 'Id Rabatt',
			'rabatt' => 'Discount',
			'id_payoption' => 'Id Payoption',
			'payoption' => 'Payoption',
			'price' => 'Price',
			'vat' => 'Vat',
			'note' => 'Note',
			'id_guide' => 'Id Guide',
			'id_tour' => 'Id Tour',
			'tour' => 'Tour',
			'id_scheduled' => 'Id Scheduled',
			'scheduled' => 'Scheduled',
			'id_report' => 'Id Report',
			'date_zakaz' => 'Date Zakaz',
			'date_report' => 'Date Report',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_contact',$this->id_contact);
		$criteria->compare('id_rabatt',$this->id_rabatt);
		$criteria->compare('id_payoption',$this->id_payoption);
		$criteria->compare('price',$this->price);
		$criteria->compare('vat',$this->vat);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('id_guide',$this->id_guide);
		$criteria->compare('id_tour',$this->id_tour);
		$criteria->compare('id_report',$this->id_report);
		$criteria->compare('date_zakaz',$this->date_zakaz);
		$criteria->compare('date_report',$this->date_report);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CurrentSubscribers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
