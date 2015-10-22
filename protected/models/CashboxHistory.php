<?php

/**
 * This is the model class for table "cashbox_history".
 *
 * The followings are the available columns in table 'cashbox_history':
 * @property integer $idcashbox_history
 * @property integer $users_id
 * @property double $delta_cash
 * @property string $timestamp
 * @property string $annotation
 * @property integer $approvedBy
 * @property double $cashBefore
 * @property integer $editedBy
 */
class CashboxHistory extends CActiveRecord
{
	private $_cli = null;
		public function getTypename(){
		if ($this->_cli === null && $this->cashboxtypes !== null)
		{
			$this->_cli = $this->cashboxtypes->name;
		}
		return $this->_cli;
	}
	public function setTypename($value){
		$this->_cli = $value;
	}
/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cashbox_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('users_id, approvedBy, editedBy', 'numerical', 'integerOnly'=>true),
			//array('delta_cash, cashBefore', 'numerical'),
			//array('annotation', 'length', 'max'=>150),
			array('timestamp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcashbox_history, users_id, delta_cash, timestamp, annotation, approvedBy, cashBefore, editedBy, id_type', 'safe', 'on'=>'search'),
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
	           'cashboxtypes'=>array(self::BELONGS_TO, 'CashboxType', 'id_type'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcashbox_history' => 'Idcashbox History',
			'users_id' => 'Users',
			'delta_cash' => 'Delta Cash',
			'timestamp' => 'Timestamp',
			'annotation' => 'Annotation',
			'approvedBy' => 'Approved By',
			'cashBefore' => 'Cash Before',
			'editedBy' => 'Edited By',
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

		$criteria->compare('idcashbox_history',$this->idcashbox_history);
		$criteria->compare('users_id',$this->users_id);
		$criteria->compare('delta_cash',$this->delta_cash);
		$criteria->compare('timestamp',$this->timestamp,true);
		$criteria->compare('annotation',$this->annotation,true);
		$criteria->compare('approvedBy',$this->approvedBy);
		$criteria->compare('cashBefore',$this->cashBefore);
		$criteria->compare('editedBy',$this->editedBy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		public function getCashboxTypes()
		{
		$usersArray = CHtml::listData($this->cashboxtypes, 'id', 'name');
		return $usersArray;
		}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CashboxHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
