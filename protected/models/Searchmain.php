<?php

class Searchmain extends CFormModel
{
    public $city;
	public $date;

	public function rules()
	{
		return array(
		//	array('time, status', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			
		);
	}
}
