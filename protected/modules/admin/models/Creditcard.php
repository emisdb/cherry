<?php

/**
 * This is the model class for table "creditcard".
 *
 * The followings are the available columns in table 'creditcard':
 * @property integer $id
 * @property string $text
 * @property string $trans_id
 * @property string $card_type
 * @property string $result_code
 * @property double $amount
 * @property string $trans_date
 */
class Creditcard extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'creditcard';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text', 'required'),
			array('amount', 'numerical'),
			array('text', 'length', 'max'=>255),
			array('trans_id', 'length', 'max'=>32),
			array('card_type', 'length', 'max'=>10),
			array('result_code', 'length', 'max'=>12),
			array('trans_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, text, trans_id, card_type, result_code, amount, trans_date', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'text' => 'Text',
			'trans_id' => 'Trans',
			'card_type' => 'Card Type',
			'result_code' => 'Result Code',
			'amount' => 'Amount',
			'trans_date' => 'Trans Date',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('trans_id',$this->trans_id,true);
		$criteria->compare('card_type',$this->card_type,true);
		$criteria->compare('result_code',$this->result_code,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('trans_date',$this->trans_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Creditcard the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
