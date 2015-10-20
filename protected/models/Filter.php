<?php

class Filter extends CFormModel
{
    public $city;
	public $date_n;
    public $time_n;
	public $language;
	public $guide;

	public function rules()
	{
		return array(
		
	
      array('city', 'default', 'value'=>'1'),


		
			//array('time, status', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
