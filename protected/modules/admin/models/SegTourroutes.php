<?php

/**
 * This is the model class for table "seg_tourroutes".
 *
 * The followings are the available columns in table 'seg_tourroutes':
 * @property integer $idseg_tourroutes
 * @property integer $id_tour_categories
 * @property string $name
 * @property string $maintext
 * @property string $maintext_en
 * @property string $shorttext
 * @property string $shorttext_en
 * @property string $gmaps_lnk
 * @property string $meetingpoint_description
 * @property string $meetingpoint_description_en
 * @property integer $TNmin
 * @property integer $TNmax
 * @property integer $inDevelopment
 * @property string $route_bigpic
 * @property string $route_pic
 * @property string $pic_icon
 * @property string $pdf_path
 * @property integer $base_price
 * @property integer $standard_duration
 * @property integer $cityid
 */
class SegTourroutes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    public $image_big; 
    public $image; 
    public $image_icon; 
    public $pdf_file; 
	public function tableName()
	{
		return 'seg_tourroutes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tour_categories, name', 'required'),
			array('idseg_tourroutes, id_tour_categories, TNmin, TNmax, inDevelopment, base_price, standard_duration, cityid', 'numerical', 'integerOnly'=>true),
			array('name, route_bigpic, route_pic, pic_icon, pdf_path', 'length', 'max'=>45),
			array('maintext, maintext_en', 'length', 'max'=>2000),
			array('shorttext, shorttext_en', 'length', 'max'=>100),
			array('meetingpoint_description, meetingpoint_description_en', 'length', 'max'=>200),
			array('gmaps_lnk', 'safe'),
            array('image_icon', 'file',
             'types'=>'jpg, JPG, png, PNG',
             'allowEmpty'=>'true',
             ),
            array('pdf_file', 'file',
             'types'=>'pdf, PDF',
             'allowEmpty'=>'true',
             ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idseg_tourroutes, id_tour_categories, name, maintext, maintext_en, shorttext, shorttext_en, gmaps_lnk, meetingpoint_description, meetingpoint_description_en, TNmin, TNmax, inDevelopment, route_bigpic, route_pic, pic_icon, pdf_path, base_price, standard_duration, cityid', 'safe', 'on'=>'search'),
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
            'tour_categories'=>array(self::BELONGS_TO, 'TourCategories', 'id_tour_categories'),
            'city'=>array(self::BELONGS_TO, 'SegCities', 'cityid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_tourroutes' => 'Idseg Tourroutes',
			'id_tour_categories' => 'Id Tour Categories',
			'name' => 'Name',
			'maintext' => 'Maintext',
			'maintext_en' => 'Maintext En',
			'shorttext' => 'Shorttext',
			'shorttext_en' => 'Shorttext En',
			'gmaps_lnk' => 'Gmaps Lnk',
			'meetingpoint_description' => 'Meetingpoint Description',
			'meetingpoint_description_en' => 'Meetingpoint Description En',
			'TNmin' => 'Tnmin',
			'TNmax' => 'Tnmax',
			'inDevelopment' => 'In Development',
			'route_bigpic' => 'Route Bigpic',
			'route_pic' => 'Route Pic',
			'pic_icon' => 'Pic Icon',
			'pdf_path' => 'Pdf Path',
			'base_price' => 'Base Price',
			'standard_duration' => 'Standard Duration',
			'cityid' => 'Cityid',
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

		$criteria->compare('idseg_tourroutes',$this->idseg_tourroutes);
		$criteria->compare('id_tour_categories',$this->id_tour_categories);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('maintext',$this->maintext,true);
		$criteria->compare('maintext_en',$this->maintext_en,true);
		$criteria->compare('shorttext',$this->shorttext,true);
		$criteria->compare('shorttext_en',$this->shorttext_en,true);
		$criteria->compare('gmaps_lnk',$this->gmaps_lnk,true);
		$criteria->compare('meetingpoint_description',$this->meetingpoint_description,true);
		$criteria->compare('meetingpoint_description_en',$this->meetingpoint_description_en,true);
		$criteria->compare('TNmin',$this->TNmin);
		$criteria->compare('TNmax',$this->TNmax);
		$criteria->compare('inDevelopment',$this->inDevelopment);
		$criteria->compare('route_bigpic',$this->route_bigpic,true);
		$criteria->compare('route_pic',$this->route_pic,true);
		$criteria->compare('pic_icon',$this->pic_icon,true);
		$criteria->compare('pdf_path',$this->pdf_path,true);
		$criteria->compare('base_price',$this->base_price);
		$criteria->compare('standard_duration',$this->standard_duration);
		$criteria->compare('cityid',$this->cityid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegTourroutes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
