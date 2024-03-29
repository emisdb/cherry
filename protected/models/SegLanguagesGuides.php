<?php

/**
 * This is the model class for table "seg_languages_guides".
 *
 * The followings are the available columns in table 'seg_languages_guides':
 * @property integer $idseg_languages_guides
 * @property integer $users_id
 * @property integer $languages_id
 */
class SegLanguagesGuides extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seg_languages_guides';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, languages_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idseg_languages_guides, users_id, languages_id, languages', 'safe', 'on'=>'search'),
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
                    'languages'=>array(self::BELONGS_TO, 'Languages', 'languages_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_languages_guides' => 'Idseg Languages Guides',
			'users_id' => 'Users',
			'languages_id' => 'ID Languages',
            'languages' => 'Languages',
		);
	}
	public function getLanguageOptions()
	{
		$usersArray = CHtml::listData($this->languages, 'id_languages', 'englishname');
		return $usersArray;
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
        $criteria->with = array('languages');
		$criteria->compare('languages.id_languages',$this->languages,true);
        
		$criteria->compare('idseg_languages_guides',$this->idseg_languages_guides);
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('languages_id',$this->languages_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegLanguagesGuides the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
