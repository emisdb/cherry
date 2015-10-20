<?php

class DayResult extends CFormModel
{
    public $id;
	public $time;
    public $starttime;
	public $status;

	public function rules()
	{
		return array(
			array('time, status', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
