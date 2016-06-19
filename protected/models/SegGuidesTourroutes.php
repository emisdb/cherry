<?php

/**
 * This is the model class for table "seg_guides_tourroutes".
 *
 * The followings are the available columns in table 'seg_guides_tourroutes':
 * @property integer $idseg_guides_tourroutes
 * @property integer $usersid
 * @property integer $tourroutes_id
 */
class SegGuidesTourroutes extends CActiveRecord
{
	public $base_provision0;
	public $base_provision1;
	public $base_provision2;

	public $guest_variable0;
	public $guest_variable1;
	public $guest_variable2;
	
		public $guestsMinforVariable0;
	public $guestsMinforVariable1;
	public $guestsMinforVariable2;
	
		public $voucher_provision0;
	public $voucher_provision1;
	public $voucher_provision2;	


	public function tableName()
	{
		return 'seg_guides_tourroutes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usersid, tourroutes_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idseg_guides_tourroutes, usersid, tourroutes_id', 'safe', 'on'=>'search'),
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
                    'tourroutes'=>array(self::BELONGS_TO, 'SegTourroutes', array( 'id_tour_categories'=>'tourroutes_id')),
                    'tour_categories'=>array(self::BELONGS_TO, 'TourCategories', 'tourroutes_id'),
			
		);
	}
        public function getToureCategories()
        {
            $usersArray = CHtml::listData($this->tour_categories, 'id_tour_categories', 'name');
            return $usersArray;
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_guides_tourroutes' => 'Idseg Guides Tourroutes',
			'usersid' => 'Usersid',
			'tourroutes_id' => 'Tourroutes',
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

		$criteria->compare('idseg_guides_tourroutes',$this->idseg_guides_tourroutes);
		$criteria->compare('usersid',$this->usersid);
		$criteria->compare('tourroutes_id',$this->tourroutes_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegGuidesTourroutes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
