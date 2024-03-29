<?php

/**
 * This is the model class for table "seg_contacts".
 *
 * The followings are the available columns in table 'seg_contacts':
 * @property integer $idcontacts
 * @property string $firstname
 * @property string $surname
 * @property string $phone
 * @property string $email
 * @property string $additional_address
 * @property string $country
 * @property string $city
 * @property string $postalcode
 * @property string $house
 * @property string $street
 * @property string $birthdate
 */
class SegContacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seg_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, surname, phone, additional_address, country, city, house, street', 'length', 'max'=>45),
			array('firstname, surname, phone, email, country', 'required'),
			array('email','email'),
			array('email', 'length', 'max'=>100),
			array('postalcode', 'length', 'max'=>11),
			array('birthdate,postalcode', 'safe'),
			array('email','email'),
			//array('email', 'unique', 'allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcontacts, firstname, surname, phone, email, additional_address, country, city, postalcode, house, street, birthdate', 'safe', 'on'=>'search'),
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
           // 'city_ob'=>array(self::BELONGS_TO, 'SegCities', 'id_segcities'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcontacts' => 'Idcontacts',
			'firstname' => 'Vorname',
			'surname' => 'Nachname',
			'phone' => 'Telefon',
			'email' => 'Email',
			'additional_address' => 'Adre&szlig;zusatz',
			'country' => 'Land',
			'city' => 'Stadt',
			'postalcode' => 'Postleitzahl',
			'house' => 'Hausnummer',
			'street' => 'Stra&szlig;e',
			'birthdate' => 'Geburtsdatum',
		);
/*		return array(
			'idcontacts' => 'Idcontacts',
			'firstname' => 'Firstname',
			'surname' => 'Surname',
			'phone' => 'Phone',
			'email' => 'Email',
			'additional_address' => 'Additional Address',
			'country' => 'Country',
			'city' => 'City',
           // 'city_ob' => 'City',
             'postalcode' => 'Postal code',
			'house' => 'House',
			'street' => 'Street',
			'birthdate' => 'Birthdate',
		);
*/	}

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

		$criteria->compare('idcontacts',$this->idcontacts);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('additional_address',$this->additional_address,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('postalcode',$this->postalcode,true);
		$criteria->compare('house',$this->house,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('birthdate',$this->birthdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegContacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
 /*   
    
    protected function afterFind() {
      //  $this->create_time = date('Y-m-d', $this->create_time);
        $this->birthdate = date('d.m.Y',strtotime($this->birthdate));
        parent::afterFind();
    }
 */  
    protected function beforeSave() {
       $this->birthdate = date('Y-m-d',strtotime($this->birthdate));
      // $this->birthdate = strtotime($this->birthdate);
       return true;
    }
    

}