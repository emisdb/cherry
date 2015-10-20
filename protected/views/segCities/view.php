<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */

$this->breadcrumbs=array(
	'Seg Cities'=>array('index'),
	$model->idseg_cities,
);

$this->menu=array(
	array('label'=>'List SegCities', 'url'=>array('index')),
	array('label'=>'Create SegCities', 'url'=>array('create')),
	array('label'=>'Update SegCities', 'url'=>array('update', 'id'=>$model->idseg_cities)),
	array('label'=>'Delete SegCities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_cities),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegCities', 'url'=>array('admin')),
);
?>

<h1>View SegCities #<?php echo $model->idseg_cities; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_cities',
		'seg_cityname',
		'shortname',
		'segway_amount',
		'mailInfo',
		'mailBuchungen',
		'mailBookings',
		'mailVoucher',
		'mailCancellation',
		'mailInfoDisplayName',
		'mailBuchungenDisplayName',
		'mailBookingsDisplayName',
		'mailVoucherDisplayName',
		'mailCancellationDisplayName',
		'webadress',
		'localPhone',
		'localStreet',
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
	),
)); ?>
