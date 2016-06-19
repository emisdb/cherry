<?php

/**
 * This is the model class for table "seg_guides_cities".
 *
 * The followings are the available columns in table 'seg_guides_cities':
 * @property integer $idseg_guides_cities
 * @property integer $users_id
 * @property integer $cities_id
 */
class SegGuidesCities extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seg_guides_cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, cities_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idseg_guides_cities, users_id, cities_id, cities', 'safe', 'on'=>'search'),
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
                 'cities'=>array(self::BELONGS_TO, 'SegCities', 'cities_id'),
                 'users'=>array(self::BELONGS_TO, 'User', 'users_id'),
		);
	}
      public function getCitiesList()
        {
            $usersArray = CHtml::listData(SegCities::model()->findAll(), 'idseg_cities', 'seg_cityname');
            return $usersArray;
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_guides_cities' => 'Idseg Guides Cities',
			'users_id' => 'Users',
			'cities_id' => 'ID Cities',
                        'cities' => 'Cities'
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
        $criteria->with = array('cities');
		$criteria->compare('cities.idseg_cities',$this->cities,true);
        
		$criteria->compare('idseg_guides_cities',$this->idseg_guides_cities);
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('cities_id',$this->cities_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegGuidesCities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
