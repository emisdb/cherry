<?php

class DayResult extends CFormModel
{
    public $id;
	public $time;
	public $date;
    public $starttime;
	public $status;

	public function rules()
	{
		return array(
			array('time, date, status', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}
}
