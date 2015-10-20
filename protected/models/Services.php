<?php

/**
 * This is the model class for table "{{services}}".
 *
 * The followings are the available columns in table '{{services}}':
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $text
 * @property string $title
 * @property string $description
 * @property string $keywrds
 * 
 */
class Services extends CActiveRecord
{
	public function tableName()
	{
		return '{{services}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, text, path', 'required'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
            array('title, description, keywords', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, path, text, sort, title, description, keywords', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
            'path' => 'Pfad',
			'text' => 'Eingabefeld',
			'sort' => 'Sortierung',
            'title' => 'Title',
			'desciption' => 'Description',
			'keywords' => 'Keywords',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
        $criteria->compare('path',$this->path,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('title',$this->title,true);
        $criteria->compare('desciption',$this->desciption,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Services the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
