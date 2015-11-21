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
    public $city_ex;
    public $city;
    public $date_ex;
    public $time_ex;
    public $cat_hidden;
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
			array('city_ex,date_ex,time_ex,cat_hidden','safe'),
			array('tour, language, firstname, lastname, city, country, phone, email, tickets, tickets1, tickets2 , tickets3, street, house, additional_address, postalcode', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
