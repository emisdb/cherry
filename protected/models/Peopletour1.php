<?php

class Peopletour extends CFormModel
{
    public $id;
	public $number;
    public $name;
	public $tourist;
	public $prmotions;
	public $method;
	public $price;
	public $vat;
	public $note;

	public function rules()
	{
		return array(
			//array('time, status', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}