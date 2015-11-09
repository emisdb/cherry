<?php

class Book extends CFormModel
{
	
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
			array('tour, language, address, firstname, lastname, city, country, phone, email', 'required'),
			array('email','email'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
