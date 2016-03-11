<?php

class TourUser extends CFormModel
{
    public $cat;
	public $tourname;

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
