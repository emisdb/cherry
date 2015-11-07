<?php

class Book extends CFormModel
{
	public $city_ex;
	public $date_ex;
    public $time_ex;
	
    public $tour;
	public $language;
    public $tickets;
    public $tickets1;
	public $tickets2;
	public $tickets3;	
	
	public $firstname;
    public $lastname;
    public $address;
    public $city;
   public $street;
   public $house;
    public $postalcode;
   public $additional_address;
    public $country;
    public $phone;
    public $email;

	public function rules()
	{
		return array(
			array('city_ex,date_ex,time_ex,tour, language, postalcode, $additional_address, house, street, firstname, lastname, address, city, country, phone, email', 'required'),
			array('email','email'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
