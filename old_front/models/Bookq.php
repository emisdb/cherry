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
			array('firstname, lastname, phone, additional_address, country, city, house, street', 'length', 'max'=>45),
			array('email', 'length', 'max'=>100),
			array('postalcode', 'length', 'max'=>11),
			array('email','email'),
			array('tickets','numerical' ),
			array('tour, language, firstname, lastname, city, country, phone, email, cat_hidden, tickets, tickets1, tickets2 , tickets3, street, house, additional_address, postalcode', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
