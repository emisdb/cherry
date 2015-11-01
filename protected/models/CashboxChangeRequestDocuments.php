<?php

/**
 * This is the model class for table "cashbox_change_request_documents".
 *
 * The followings are the available columns in table 'cashbox_change_request_documents':
 * @property integer $idcashbox_change_request_documents
 * @property string $link
 * @property integer $cashbox_change_requestid
 */
class CashboxChangeRequestDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cashbox_change_request_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('link, cashbox_change_requestid', 'required'),
			array('cashbox_change_requestid', 'numerical', 'integerOnly'=>true),
			array('link', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcashbox_change_request_documents, link, cashbox_change_requestid', 'safe', 'on'=>'search'),
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
			'idcashbox_change_request_documents' => 'Idcashbox Change Request Documents',
			'link' => 'Link',
			'cashbox_change_requestid' => 'Cashbox Change Requestid',
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

		$criteria->compare('idcashbox_change_request_documents',$this->idcashbox_change_request_documents);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('cashbox_change_requestid',$this->cashbox_change_requestid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CashboxChangeRequestDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
