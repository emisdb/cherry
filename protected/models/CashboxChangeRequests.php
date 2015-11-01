<?php

/**
 * This is the model class for table "cashbox_change_requests".
 *
 * The followings are the available columns in table 'cashbox_change_requests':
 * @property integer $idcashbox_change_requests
 * @property integer $id_users
 * @property integer $id_type
 * @property double $delta_cash
 * @property string $reason
 * @property integer $isApproved
 * @property integer $approvedBy
 * @property string $request_date
 * @property string $approval_date
 */
class CashboxChangeRequests extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cashbox_change_requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_users, id_type, delta_cash, reason, approvedBy, request_date, approval_date', 'required'),
			array('id_users, id_type, isApproved, approvedBy', 'numerical', 'integerOnly'=>true),
			array('delta_cash', 'numerical'),
			array('reason', 'length', 'max'=>1500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcashbox_change_requests, id_users, id_type, delta_cash, reason, isApproved, approvedBy, request_date, approval_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcashbox_change_requests' => 'Idcashbox Change Requests',
			'id_users' => 'Id Users',
			'id_type' => 'Id Type',
			'delta_cash' => 'Delta Cash',
			'reason' => 'Reason',
			'isApproved' => 'Is Approved',
			'approvedBy' => 'Approved By',
			'request_date' => 'Request Date',
			'approval_date' => 'Approval Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idcashbox_change_requests',$this->idcashbox_change_requests);
		$criteria->compare('id_users',$this->id_users);
		$criteria->compare('id_type',$this->id_type);
		$criteria->compare('delta_cash',$this->delta_cash);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('isApproved',$this->isApproved);
		$criteria->compare('approvedBy',$this->approvedBy);
		$criteria->compare('request_date',$this->request_date,true);
		$criteria->compare('approval_date',$this->approval_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CashboxChangeRequests the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
