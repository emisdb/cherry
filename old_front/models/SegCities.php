<?php

/**
 * This is the model class for table "seg_cities".
 *
 * The followings are the available columns in table 'seg_cities':
 * @property integer $idseg_cities
 * @property string $seg_cityname
 * @property string $shortname
 * @property integer $segway_amount
 * @property string $mailInfo
 * @property string $mailBuchungen
 * @property string $mailBookings
 * @property string $mailVoucher
 * @property string $mailCancellation
 * @property string $mailInfoDisplayName
 * @property string $mailBuchungenDisplayName
 * @property string $mailBookingsDisplayName
 * @property string $mailVoucherDisplayName
 * @property string $mailCancellationDisplayName
 * @property string $webadress
 * @property string $localPhone
 * @property string $localStreet
 * @property string $localHouse
 * @property string $localPLZ
 * @property string $mailInfoAccount
 * @property string $mailBuchungenAccount
 * @property string $mailBookingsAccount
 * @property string $mailVoucherAccount
 * @property string $mailCancellationAccount
 * @property string $mailInfoPW
 * @property string $mailBuchungenPW
 * @property string $mailBookingsPW
 * @property string $mailVoucherPW
 * @property string $mailCancellationPW
 * @property string $webadress_en
 * @property string $gmaps_lnk
 * @property string $meetingpoint_description
 * @property string $meetingpoint_description_en
 * @property integer $standart_toursize
 * @property string $cashaccount_DTV
 * @property string $tripadvisor_lnk
 * @property string $facebook_lnk
 * @property string $google_analytics_id
 * @property integer $google_conversions_id
 * @property string $google_conversions_label
 * @property string $google_analytics_id_booking_de
 * @property string $google_conversions_id_booking_de
 * @property string $google_conversions_label_booking_de
 * @property string $google_analytics_id_booking_en
 * @property string $google_conversions_id_booking_en
 * @property string $google_conversions_label_booking_en
 */
class SegCities extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seg_cities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mailInfoAccount, mailBuchungenAccount, mailBookingsAccount, mailVoucherAccount, mailCancellationAccount, mailInfoPW, mailBuchungenPW, mailBookingsPW, mailVoucherPW, mailCancellationPW, webadress_en, gmaps_lnk, meetingpoint_description, meetingpoint_description_en, standart_toursize, cashaccount_DTV, tripadvisor_lnk, facebook_lnk, google_analytics_id, google_conversions_id, google_conversions_label, google_analytics_id_booking_de, google_conversions_id_booking_de, google_conversions_label_booking_de, google_analytics_id_booking_en, google_conversions_id_booking_en, google_conversions_label_booking_en', 'required'),
			array('segway_amount, standart_toursize, google_conversions_id', 'numerical', 'integerOnly'=>true),
			array('seg_cityname, mailInfo, mailBuchungen, mailBookings, mailVoucher, mailCancellation, mailInfoDisplayName, mailBuchungenDisplayName, mailBookingsDisplayName, mailVoucherDisplayName, mailCancellationDisplayName, webadress, localPhone, localPLZ, mailInfoAccount, mailBuchungenAccount, mailBookingsAccount, mailVoucherAccount, mailCancellationAccount, mailInfoPW, mailBuchungenPW, mailBookingsPW, mailVoucherPW, mailCancellationPW, webadress_en', 'length', 'max'=>45),
			array('shortname', 'length', 'max'=>3),
			array('localStreet', 'length', 'max'=>60),
			array('localHouse', 'length', 'max'=>10),
			array('gmaps_lnk, meetingpoint_description, meetingpoint_description_en', 'length', 'max'=>200),
			array('cashaccount_DTV', 'length', 'max'=>5),
			array('tripadvisor_lnk, facebook_lnk', 'length', 'max'=>100),
			array('google_analytics_id, google_conversions_label', 'length', 'max'=>20),
			array('google_analytics_id_booking_de, google_conversions_id_booking_de, google_conversions_label_booking_de, google_analytics_id_booking_en, google_conversions_id_booking_en, google_conversions_label_booking_en', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idseg_cities, seg_cityname, shortname, segway_amount, mailInfo, mailBuchungen, mailBookings, mailVoucher, mailCancellation, mailInfoDisplayName, mailBuchungenDisplayName, mailBookingsDisplayName, mailVoucherDisplayName, mailCancellationDisplayName, webadress, localPhone, localStreet, localHouse, localPLZ, mailInfoAccount, mailBuchungenAccount, mailBookingsAccount, mailVoucherAccount, mailCancellationAccount, mailInfoPW, mailBuchungenPW, mailBookingsPW, mailVoucherPW, mailCancellationPW, webadress_en, gmaps_lnk, meetingpoint_description, meetingpoint_description_en, standart_toursize, cashaccount_DTV, tripadvisor_lnk, facebook_lnk, google_analytics_id, google_conversions_id, google_conversions_label, google_analytics_id_booking_de, google_conversions_id_booking_de, google_conversions_label_booking_de, google_analytics_id_booking_en, google_conversions_id_booking_en, google_conversions_label_booking_en', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{

		return array(
			'users' => array(self::MANY_MANY, 'User', 'seg_guides_cities(cities_id, users_id)'),
			'tourrouts' => array(self::HAS_MANY, 'SegTourroutes', 'cityid'),
		);
	}
		public function getUserOptions()
		{
				$usersArray = CHtml::listData($this->users, 'id', 'contact_ob.firstname');
		return $usersArray;
		}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idseg_cities' => 'Id Cities',
			'seg_cityname' => 'City name',
			'shortname' => 'Short name',
			'segway_amount' => 'Amount',
			'mailInfo' => 'Mail Info',
			'mailBuchungen' => 'Mail Buchungen',
			'mailBookings' => 'Mail Bookings',
			'mailVoucher' => 'Mail Voucher',
			'mailCancellation' => 'Mail Cancellation',
			'mailInfoDisplayName' => 'Mail Info Display Name',
			'mailBuchungenDisplayName' => 'Mail Buchungen Display Name',
			'mailBookingsDisplayName' => 'Mail Bookings Display Name',
			'mailVoucherDisplayName' => 'Mail Voucher Display Name',
			'mailCancellationDisplayName' => 'Mail Cancellation Display Name',
			'webadress' => 'Webadress',
			'localPhone' => 'Local Phone',
			'localStreet' => 'Local Street',
			'localHouse' => 'Local House',
			'localPLZ' => 'Local Plz',
			'mailInfoAccount' => 'Mail Info Account',
			'mailBuchungenAccount' => 'Mail Buchungen Account',
			'mailBookingsAccount' => 'Mail Bookings Account',
			'mailVoucherAccount' => 'Mail Voucher Account',
			'mailCancellationAccount' => 'Mail Cancellation Account',
			'mailInfoPW' => 'Mail Info Pw',
			'mailBuchungenPW' => 'Mail Buchungen Pw',
			'mailBookingsPW' => 'Mail Bookings Pw',
			'mailVoucherPW' => 'Mail Voucher Pw',
			'mailCancellationPW' => 'Mail Cancellation Pw',
			'webadress_en' => 'Webadress En',
			'gmaps_lnk' => 'Gmaps Lnk',
			'meetingpoint_description' => 'Meetingpoint Description',
			'meetingpoint_description_en' => 'Meetingpoint Description En',
			'standart_toursize' => 'Standart Toursize',
			'cashaccount_DTV' => 'Cashaccount Dtv',
			'tripadvisor_lnk' => 'Tripadvisor Lnk',
			'facebook_lnk' => 'Facebook Lnk',
			'google_analytics_id' => 'Google Analytics',
			'google_conversions_id' => 'Google Conversions',
			'google_conversions_label' => 'Google Conversions Label',
			'google_analytics_id_booking_de' => 'Google Analytics Id Booking De',
			'google_conversions_id_booking_de' => 'Google Conversions Id Booking De',
			'google_conversions_label_booking_de' => 'Google Conversions Label Booking De',
			'google_analytics_id_booking_en' => 'Google Analytics Id Booking En',
			'google_conversions_id_booking_en' => 'Google Conversions Id Booking En',
			'google_conversions_label_booking_en' => 'Google Conversions Label Booking En',
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

		$criteria->compare('idseg_cities',$this->idseg_cities);
		$criteria->compare('seg_cityname',$this->seg_cityname,true);
		$criteria->compare('shortname',$this->shortname,true);
		$criteria->compare('segway_amount',$this->segway_amount);
		$criteria->compare('mailInfo',$this->mailInfo,true);
		$criteria->compare('mailBuchungen',$this->mailBuchungen,true);
		$criteria->compare('mailBookings',$this->mailBookings,true);
		$criteria->compare('mailVoucher',$this->mailVoucher,true);
		$criteria->compare('mailCancellation',$this->mailCancellation,true);
		$criteria->compare('mailInfoDisplayName',$this->mailInfoDisplayName,true);
		$criteria->compare('mailBuchungenDisplayName',$this->mailBuchungenDisplayName,true);
		$criteria->compare('mailBookingsDisplayName',$this->mailBookingsDisplayName,true);
		$criteria->compare('mailVoucherDisplayName',$this->mailVoucherDisplayName,true);
		$criteria->compare('mailCancellationDisplayName',$this->mailCancellationDisplayName,true);
		$criteria->compare('webadress',$this->webadress,true);
		$criteria->compare('localPhone',$this->localPhone,true);
		$criteria->compare('localStreet',$this->localStreet,true);
		$criteria->compare('localHouse',$this->localHouse,true);
		$criteria->compare('localPLZ',$this->localPLZ,true);
		$criteria->compare('mailInfoAccount',$this->mailInfoAccount,true);
		$criteria->compare('mailBuchungenAccount',$this->mailBuchungenAccount,true);
		$criteria->compare('mailBookingsAccount',$this->mailBookingsAccount,true);
		$criteria->compare('mailVoucherAccount',$this->mailVoucherAccount,true);
		$criteria->compare('mailCancellationAccount',$this->mailCancellationAccount,true);
		$criteria->compare('mailInfoPW',$this->mailInfoPW,true);
		$criteria->compare('mailBuchungenPW',$this->mailBuchungenPW,true);
		$criteria->compare('mailBookingsPW',$this->mailBookingsPW,true);
		$criteria->compare('mailVoucherPW',$this->mailVoucherPW,true);
		$criteria->compare('mailCancellationPW',$this->mailCancellationPW,true);
		$criteria->compare('webadress_en',$this->webadress_en,true);
		$criteria->compare('gmaps_lnk',$this->gmaps_lnk,true);
		$criteria->compare('meetingpoint_description',$this->meetingpoint_description,true);
		$criteria->compare('meetingpoint_description_en',$this->meetingpoint_description_en,true);
		$criteria->compare('standart_toursize',$this->standart_toursize);
		$criteria->compare('cashaccount_DTV',$this->cashaccount_DTV,true);
		$criteria->compare('tripadvisor_lnk',$this->tripadvisor_lnk,true);
		$criteria->compare('facebook_lnk',$this->facebook_lnk,true);
		$criteria->compare('google_analytics_id',$this->google_analytics_id,true);
		$criteria->compare('google_conversions_id',$this->google_conversions_id);
		$criteria->compare('google_conversions_label',$this->google_conversions_label,true);
		$criteria->compare('google_analytics_id_booking_de',$this->google_analytics_id_booking_de,true);
		$criteria->compare('google_conversions_id_booking_de',$this->google_conversions_id_booking_de,true);
		$criteria->compare('google_conversions_label_booking_de',$this->google_conversions_label_booking_de,true);
		$criteria->compare('google_analytics_id_booking_en',$this->google_analytics_id_booking_en,true);
		$criteria->compare('google_conversions_id_booking_en',$this->google_conversions_id_booking_en,true);
		$criteria->compare('google_conversions_label_booking_en',$this->google_conversions_label_booking_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SegCities the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
