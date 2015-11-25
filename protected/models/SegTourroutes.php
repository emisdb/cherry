<?php

/**
 * This is the model class for table "seg_tourroutes".
 *
 * The followings are the available columns in table 'seg_tourroutes':
 * @property integer $idseg_tourroutes
 * @property string $name
 * @property string $maintext
 * @property string $shorttext
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
    public $image_big; 
    public $image; 
    public $image_icon; 
    public $pdf_file; 
	public function tableName()
	{
		return 'seg_tourroutes';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('idseg_tourroutes, TNmin, TNmax, inDevelopment, base_price, standard_duration, cityid', 'numerical', 'integerOnly'=>true),
			array('name, route_bigpic, route_pic, pic_icon, pdf_path', 'length', 'max'=>45),
			array('maintext', 'length', 'max'=>2000),
			array('shorttext', 'length', 'max'=>1000),
           // array('image_big', 'file', 'types'=>'jpg, JPG'),
          //  array('image', 'file', 'types'=>'jpg, JPG'),
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
			array('idseg_tourroutes, tour_categories, name, maintext, shorttext, TNmin, TNmax, inDevelopment, image_big, image, image_icon, route_bigpic, route_pic, pic_icon, pdf_path, pdf_file, base_price, standard_duration, city, cityid', 'safe', 'on'=>'search'),
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
            'tour_categories' => 'Tour categories',
			'name' => 'Name',
			'maintext' => 'Maintext',
			'shorttext' => 'Shorttext',
			'TNmin' => 'Tnmin',
			'TNmax' => 'Tnmax',
			'inDevelopment' => 'In Development',
            'image_big' => 'Image Big',
            'image' => 'Image',
            'image_icon' => 'Image Icon',
			'route_bigpic' => 'Route Bigpic',
			'route_pic' => 'Route Pic',
			'pic_icon' => 'Pic Icon',
			'pdf_path' => 'Pdf Path',
            'pdf_file' => 'Pdf File',
			'base_price' => 'Price',
			'standard_duration' => 'Duration',
            'city' => 'City',
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
        
        $criteria->with = array('tour_categories','city');
		$criteria->compare('tour_categories.id_tour_categories',$this->tour_categories);
		$criteria->compare('city.idseg_cities',$this->city);

		$criteria->compare('idseg_tourroutes',$this->idseg_tourroutes);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('maintext',$this->maintext,true);
		$criteria->compare('shorttext',$this->shorttext,true);
		$criteria->compare('TNmin',$this->TNmin);
		$criteria->compare('TNmax',$this->TNmax);
		$criteria->compare('inDevelopment',$this->inDevelopment);
		$criteria->compare('route_bigpic',$this->route_bigpic,true);
		$criteria->compare('route_pic',$this->route_pic,true);
		$criteria->compare('pic_icon',$this->pic_icon,true);
		$criteria->compare('pdf_path',$this->pdf_path,true);
		$criteria->compare('base_price',$this->base_price,true);
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
