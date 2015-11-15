<?php

class Bookq extends CFormModel
{
	
    public $tour;
	public $language;
    public $tickets;
    public $tickets1;
	public $tickets2;
	public $tickets3;	
	
	public $cat_hidden;
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
			array('firstname, lastname, city, country, phone, email', 'required'),
			array('email','email'),
			array('tour, language, firstname, lastname, city, country, phone, email, cat_hidden, tickets1, tickets2 , tickets3, street, house, additional_address, postalcode', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
