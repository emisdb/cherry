<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */

$this->breadcrumbs=array(
	//'Seg Cities'=>array('index'),
	'Cities',
);

?>

<h1>Cities</h1>
<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segCities/create">New record</a></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seg-cities-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
	//	'idseg_cities',
		'seg_cityname',
		'shortname',
	//	'segway_amount',
		'mailInfo',
	//	'mailBuchungen',
		/*
		'mailBookings',
		'mailVoucher',
		'mailCancellation',
		'mailInfoDisplayName',
		'mailBuchungenDisplayName',
		'mailBookingsDisplayName',
		'mailVoucherDisplayName',
		'mailCancellationDisplayName',
		'webadress',*/
		'localPhone',
	/*	'localStreet',
		'localHouse',
		'localPLZ',
		'mailInfoAccount',
		'mailBuchungenAccount',
		'mailBookingsAccount',
		'mailVoucherAccount',
		'mailCancellationAccount',
		'mailInfoPW',
		'mailBuchungenPW',
		'mailBookingsPW',
		'mailVoucherPW',
		'mailCancellationPW',
		'webadress_en',
		'gmaps_lnk',
		'meetingpoint_description',
		'meetingpoint_description_en',
		'standart_toursize',
		'cashaccount_DTV',
		'tripadvisor_lnk',
		'facebook_lnk',
		'google_analytics_id',
		'google_conversions_id',
		'google_conversions_label',
		'google_analytics_id_booking_de',
		'google_conversions_id_booking_de',
		'google_conversions_label_booking_de',
		'google_analytics_id_booking_en',
		'google_conversions_id_booking_en',
		'google_conversions_label_booking_en',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
