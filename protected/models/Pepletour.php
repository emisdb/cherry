<?php

/**
 * This is the model class for table "{{pepletour}}".
 *
 * The followings are the available columns in table '{{pepletour}}':
 * @property integer $id
 * @property integer $number
 * @property string $name
 * @property integer $tourist
 * @property integer $promotions
 * @property integer $method
 * @property integer $price
 * @property integer $vat
 * @property string $note
 * @property integer $text
 * @property integer $sort
 * @property integer $visited
 * @property integer $created
 */
class Pepletour extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pepletour}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('number, name, tourist, promotions, method, price, vat, note, text, sort, visited, created', 'required'),
			array('number, tourist, promotions, method, price, vat, id_guide, id_tour, visited, created', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			array('note', 'length', 'max'=>2000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, number, name, tourist, promotions, method, price, vat, note, id_guide, id_tour, visited, created', 'safe', 'on'=>'search'),
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
			'number' => 'Number',
			'name' => 'Name',
			'tourist' => 'Tourist',
			'promotions' => 'Promotions',
			'method' => 'Method',
			'price' => 'Price',
			'vat' => 'Vat',
			'note' => 'Note',
			'id_guide' => ' ID guide',
			'id_tour' => 'ID tour',
			'visited' => 'Visited',
			'created' => 'Created',
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
		$criteria->compare('number',$this->number);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tourist',$this->tourist);
		$criteria->compare('promotions',$this->promotions);
		$criteria->compare('method',$this->method);
		$criteria->compare('price',$this->price);
		$criteria->compare('vat',$this->vat);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('id_guide',$this->id_guide);
		$criteria->compare('id_tour',$this->id_tour);
		$criteria->compare('visited',$this->visited);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pepletour the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
