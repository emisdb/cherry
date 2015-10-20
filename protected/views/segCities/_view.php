<?php
/* @var $this SegCitiesController */
/* @var $data SegCities */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_cities')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_cities), array('view', 'id'=>$data->idseg_cities)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seg_cityname')); ?>:</b>
	<?php echo CHtml::encode($data->seg_cityname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shortname')); ?>:</b>
	<?php echo CHtml::encode($data->shortname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('segway_amount')); ?>:</b>
	<?php echo CHtml::encode($data->segway_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailInfo')); ?>:</b>
	<?php echo CHtml::encode($data->mailInfo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBuchungen')); ?>:</b>
	<?php echo CHtml::encode($data->mailBuchungen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBookings')); ?>:</b>
	<?php echo CHtml::encode($data->mailBookings); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('mailVoucher')); ?>:</b>
	<?php echo CHtml::encode($data->mailVoucher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailCancellation')); ?>:</b>
	<?php echo CHtml::encode($data->mailCancellation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailInfoDisplayName')); ?>:</b>
	<?php echo CHtml::encode($data->mailInfoDisplayName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBuchungenDisplayName')); ?>:</b>
	<?php echo CHtml::encode($data->mailBuchungenDisplayName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBookingsDisplayName')); ?>:</b>
	<?php echo CHtml::encode($data->mailBookingsDisplayName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailVoucherDisplayName')); ?>:</b>
	<?php echo CHtml::encode($data->mailVoucherDisplayName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailCancellationDisplayName')); ?>:</b>
	<?php echo CHtml::encode($data->mailCancellationDisplayName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('webadress')); ?>:</b>
	<?php echo CHtml::encode($data->webadress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('localPhone')); ?>:</b>
	<?php echo CHtml::encode($data->localPhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('localStreet')); ?>:</b>
	<?php echo CHtml::encode($data->localStreet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('localHouse')); ?>:</b>
	<?php echo CHtml::encode($data->localHouse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('localPLZ')); ?>:</b>
	<?php echo CHtml::encode($data->localPLZ); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailInfoAccount')); ?>:</b>
	<?php echo CHtml::encode($data->mailInfoAccount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBuchungenAccount')); ?>:</b>
	<?php echo CHtml::encode($data->mailBuchungenAccount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBookingsAccount')); ?>:</b>
	<?php echo CHtml::encode($data->mailBookingsAccount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailVoucherAccount')); ?>:</b>
	<?php echo CHtml::encode($data->mailVoucherAccount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailCancellationAccount')); ?>:</b>
	<?php echo CHtml::encode($data->mailCancellationAccount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailInfoPW')); ?>:</b>
	<?php echo CHtml::encode($data->mailInfoPW); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBuchungenPW')); ?>:</b>
	<?php echo CHtml::encode($data->mailBuchungenPW); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailBookingsPW')); ?>:</b>
	<?php echo CHtml::encode($data->mailBookingsPW); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailVoucherPW')); ?>:</b>
	<?php echo CHtml::encode($data->mailVoucherPW); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailCancellationPW')); ?>:</b>
	<?php echo CHtml::encode($data->mailCancellationPW); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('webadress_en')); ?>:</b>
	<?php echo CHtml::encode($data->webadress_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gmaps_lnk')); ?>:</b>
	<?php echo CHtml::encode($data->gmaps_lnk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meetingpoint_description')); ?>:</b>
	<?php echo CHtml::encode($data->meetingpoint_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meetingpoint_description_en')); ?>:</b>
	<?php echo CHtml::encode($data->meetingpoint_description_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('standart_toursize')); ?>:</b>
	<?php echo CHtml::encode($data->standart_toursize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cashaccount_DTV')); ?>:</b>
	<?php echo CHtml::encode($data->cashaccount_DTV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tripadvisor_lnk')); ?>:</b>
	<?php echo CHtml::encode($data->tripadvisor_lnk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('facebook_lnk')); ?>:</b>
	<?php echo CHtml::encode($data->facebook_lnk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_analytics_id')); ?>:</b>
	<?php echo CHtml::encode($data->google_analytics_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_conversions_id')); ?>:</b>
	<?php echo CHtml::encode($data->google_conversions_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_conversions_label')); ?>:</b>
	<?php echo CHtml::encode($data->google_conversions_label); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_analytics_id_booking_de')); ?>:</b>
	<?php echo CHtml::encode($data->google_analytics_id_booking_de); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_conversions_id_booking_de')); ?>:</b>
	<?php echo CHtml::encode($data->google_conversions_id_booking_de); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_conversions_label_booking_de')); ?>:</b>
	<?php echo CHtml::encode($data->google_conversions_label_booking_de); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_analytics_id_booking_en')); ?>:</b>
	<?php echo CHtml::encode($data->google_analytics_id_booking_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_conversions_id_booking_en')); ?>:</b>
	<?php echo CHtml::encode($data->google_conversions_id_booking_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('google_conversions_label_booking_en')); ?>:</b>
	<?php echo CHtml::encode($data->google_conversions_label_booking_en); ?>
	<br />

	*/ ?>

</div>