<?php

/**
 * This is the model class for table "{{languages}}".
 *
 * The followings are the available columns in table '{{languages}}':
 * @property integer $id_languages
 * @property string $shortname
 * @property string $germanname
 * @property string $englishname
 * @property string $flagpic
 */
class Languages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{languages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flagpic', 'required'),
			array('shortname', 'length', 'max'=>3),
			array('germanname, englishname, flagpic', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_languages, shortname, germanname, englishname, flagpic', 'safe', 'on'=>'search'),
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
			'id_languages' => 'Id Languages',
			'shortname' => 'Shortname',
			'germanname' => 'Germanname',
			'englishname' => 'Englishname',
			'flagpic' => 'Flagpic',
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

		$criteria->compare('id_languages',$this->id_languages);
		$criteria->compare('shortname',$this->shortname,true);
		$criteria->compare('germanname',$this->germanname,true);
		$criteria->compare('englishname',$this->englishname,true);
		$criteria->compare('flagpic',$this->flagpic,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Languages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
