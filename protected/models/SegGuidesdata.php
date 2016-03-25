<?php

/**
 * This is the model class for table "seg_guidesdata".
 *
 * The followings are the available columns in table 'seg_guidesdata':
 * @property integer $idseg_guidesdata
 * @property integer $base_provision
 * @property double $cash_box
 * @property string $guide_shorttext
 * @property string $guide_shorttext_En
 * @property string $guide_maintext
 * @property string $guide_maintext_En
 * @property string $lnk_to_picture
 * @property string $lnk_to_license
 * @property integer $guest_variable
 * @property integer $paysUSt
 * @property integer $guestsMinforVariable
 * @property string $taxnumber
 * @property string $taxoffice
 * @property integer $invoiceCount2013
 * @property integer $invoiceCount2014
 * @property integer $inVoiceCount2015
 * @property double $voucher_cashbox
 * @property double $voucher_provision
 * @property integer $immediate_voucher_payment
 * @property string $guides_cashbox_account_DTV
 * @property string $BIC
 * @property string $IBAN
 */
class SegGuidesdata extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const REMINDER_NONE=0;
	const REMINDER_MAIL=1;
	const REMINDER_SMS=2;
	const REMINDER_BOTH=3;
	public $image; 
	public $doc; 
	public function tableName()
	{
		return 'seg_guidesdata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('guides_cashbox_account_DTV, BIC, IBAN', 'required'),
			array('base_provision, guest_variable, paysUSt, guestsMinforVariable, invoiceCount2013, invoiceCount2014, inVoiceCount2015, immediate_voucher_payment', 'numerical', 'integerOnly'=>true),
			array('cash_box, voucher_cashbox, voucher_provision', 'numerical'),
			array('guide_shorttext, guide_shorttext_En', 'length', 'max'=>50),
			array('guide_maintext, guide_maintext_En', 'length', 'max'=>500),
			array('lnk_to_picture, lnk_to_license, taxnumber, taxoffice', 'length', 'max'=>45),
			array('guides_cashbox_account_DTV', 'length', 'max'=>5),
			array('BIC, IBAN', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idseg_guidesdata, base_provision, cash_box, guide_shorttext, guide_shorttext_En, guide_maintext, guide_maintext_En, lnk_to_picture, lnk_to_license, guest_variable, paysUSt, guestsMinforVariable, taxnumber, taxoffice, invoiceCount2013, invoiceCount2014, inVoiceCount2015, voucher_cashbox, voucher_provision, immediate_voucher_payment, guides_cashbox_account_DTV, BIC, IBAN', 'safe', 'on'=>'search'),
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
           'user_ob'=>array(self::HAS_ONE, 'User', 'id_guide'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_guidesdata' => 'Idseg Guidesdata',
			'base_provision' => 'Base Provision',
			'cash_box' => 'Cash Box',
			'guide_shorttext' => 'Kurzbeschreibung',
			'guide_maintext' => 'Haupttext',
			'guide_shorttext_En' => 'Guide Shorttext',
			'guide_maintext_En' => 'Guide Maintext',
			'lnk_to_picture' => 'Bild',
                          'image' => 'Image',
			'lnk_to_license' => 'Lnk To License',
			'paysUSt' => 'Pays Ust',
			'guestsMinforVariable' => 'Guests Minfor Variable',
			'taxnumber' => 'Taxnumber',
			'taxoffice' => 'Taxoffice',
			'invoiceCount2013' => 'Typ',
			'invoiceCount2014' => 'Vorlauf in Stunden',
			'inVoiceCount2015' => 'In Voice Count2015',
			'voucher_cashbox' => 'Voucher Cashbox',
			'voucher_provision' => 'Voucher Provision',
			'immediate_voucher_payment' => 'Immediate Voucher Payment',
			'guides_cashbox_account_DTV' => 'Guides Cashbox Account Dtv',
			'BIC' => 'Bic',
			'IBAN' => 'Iban',
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

		$criteria->compare('idseg_guidesdata',$this->idseg_guidesdata);
		$criteria->compare('base_provision',$this->base_provision);
		$criteria->compare('cash_box',$this->cash_box);
		$criteria->compare('guide_shorttext',$this->guide_shorttext,true);
		$criteria->compare('guide_shorttext_En',$this->guide_shorttext_En,true);
		$criteria->compare('guide_maintext',$this->guide_maintext,true);
		$criteria->compare('guide_maintext_En',$this->guide_maintext_En,true);
		$criteria->compare('lnk_to_picture',$this->lnk_to_picture,true);
		$criteria->compare('lnk_to_license',$this->lnk_to_license,true);
		$criteria->compare('guest_variable',$this->guest_variable);
		$criteria->compare('paysUSt',$this->paysUSt);
		$criteria->compare('guestsMinforVariable',$this->guestsMinforVariable);
		$criteria->compare('taxnumber',$this->taxnumber,true);
		$criteria->compare('taxoffice',$this->taxoffice,true);
		$criteria->compare('invoiceCount2013',$this->invoiceCount2013);
		$criteria->compare('invoiceCount2014',$this->invoiceCount2014);
		$criteria->compare('inVoiceCount2015',$this->inVoiceCount2015);
		$criteria->compare('voucher_cashbox',$this->voucher_cashbox);
		$criteria->compare('voucher_provision',$this->voucher_provision);
		$criteria->compare('immediate_voucher_payment',$this->immediate_voucher_payment);
		$criteria->compare('guides_cashbox_account_DTV',$this->guides_cashbox_account_DTV,true);
		$criteria->compare('BIC',$this->BIC,true);
		$criteria->compare('IBAN',$this->IBAN,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegGuidesdata the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        	public function getGuideNames()
	{
		   $criteria=new CDbCriteria;
		   $criteria->with=array('user_ob'=>array('select'=>array('user_ob.id','user_ob.username'),'with'=>
//								array('contact_ob'=>array('select'=>array('contact_ob.firstname+" "+contact_ob.surname'))) ));
//								array('contact_ob'=>array('select'=>array('contact_ob.firstname', 'contact_ob.surname'))) ));
								array('contact_ob'=>array('select'=>array('contact_ob.firstname','contact_ob.surname','CONCAT(contact_ob.firstname,  " ", contact_ob.surname ) as operator'))) ));
		   $criteria->select=array('idseg_guidesdata');
//		   $criteria->with=array('user_ob'=>array('contact_ob'));
//		   $criteria->select=new CDbExpression('user_ob.id as uid, CONCAT( contact_ob.firstname,  " ", contact_ob.surname ) as operator');
//		   $criteria->select=array('*','user_ob.id as uid', 'CONCAT( contact_ob.firstname,  " ", contact_ob.surname ) as operator');
//			return SegGuidesdata::model()->with(array('user_ob'=>array('contact_ob')))->findAll($criteria);
			return $this->findAll($criteria);
	}
	public function getReminderOptions()
	{
		return array(
	 self::REMINDER_NONE=>'Keine',
	 self::REMINDER_SMS=>'SMS',
	 self::REMINDER_MAIL=>'Email',
	 self::REMINDER_BOTH=>'Beides',
		);
	}

}
