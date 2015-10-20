<?php

/**
 * This is the model class for table "{{bonus}}".
 *
 * The followings are the available columns in table '{{bonus}}':
 * @property integer $id
 * @property integer $val
 * @property string $name
 * @property integer $sort
 */
class Bonus extends CActiveRecord
{
	public $nametype;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{bonus}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('val, name, type, sort', 'required'),
			array('val, sort', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>10),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, val, type, name, sort', 'safe', 'on'=>'search'),
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
			'val' => 'Value',
			'type' => 'Type',
			'name' => 'Name',
			'sort' => 'Sort',
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
        $criteria->order = 'sort ASC';
		$criteria->compare('id',$this->id);
		$criteria->compare('val',$this->val);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('sort',$this->sort);

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
	 * @return Bonus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
