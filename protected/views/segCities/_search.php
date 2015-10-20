<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_cities'); ?>
		<?php echo $form->textField($model,'idseg_cities'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seg_cityname'); ?>
		<?php echo $form->textField($model,'seg_cityname',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shortname'); ?>
		<?php echo $form->textField($model,'shortname',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'segway_amount'); ?>
		<?php echo $form->textField($model,'segway_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailInfo'); ?>
		<?php echo $form->textField($model,'mailInfo',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBuchungen'); ?>
		<?php echo $form->textField($model,'mailBuchungen',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBookings'); ?>
		<?php echo $form->textField($model,'mailBookings',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailVoucher'); ?>
		<?php echo $form->textField($model,'mailVoucher',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailCancellation'); ?>
		<?php echo $form->textField($model,'mailCancellation',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailInfoDisplayName'); ?>
		<?php echo $form->textField($model,'mailInfoDisplayName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBuchungenDisplayName'); ?>
		<?php echo $form->textField($model,'mailBuchungenDisplayName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBookingsDisplayName'); ?>
		<?php echo $form->textField($model,'mailBookingsDisplayName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailVoucherDisplayName'); ?>
		<?php echo $form->textField($model,'mailVoucherDisplayName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailCancellationDisplayName'); ?>
		<?php echo $form->textField($model,'mailCancellationDisplayName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'webadress'); ?>
		<?php echo $form->textField($model,'webadress',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'localPhone'); ?>
		<?php echo $form->textField($model,'localPhone',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'localStreet'); ?>
		<?php echo $form->textField($model,'localStreet',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'localHouse'); ?>
		<?php echo $form->textField($model,'localHouse',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'localPLZ'); ?>
		<?php echo $form->textField($model,'localPLZ',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailInfoAccount'); ?>
		<?php echo $form->textField($model,'mailInfoAccount',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBuchungenAccount'); ?>
		<?php echo $form->textField($model,'mailBuchungenAccount',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBookingsAccount'); ?>
		<?php echo $form->textField($model,'mailBookingsAccount',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailVoucherAccount'); ?>
		<?php echo $form->textField($model,'mailVoucherAccount',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailCancellationAccount'); ?>
		<?php echo $form->textField($model,'mailCancellationAccount',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailInfoPW'); ?>
		<?php echo $form->textField($model,'mailInfoPW',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBuchungenPW'); ?>
		<?php echo $form->textField($model,'mailBuchungenPW',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailBookingsPW'); ?>
		<?php echo $form->textField($model,'mailBookingsPW',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailVoucherPW'); ?>
		<?php echo $form->textField($model,'mailVoucherPW',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mailCancellationPW'); ?>
		<?php echo $form->textField($model,'mailCancellationPW',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'webadress_en'); ?>
		<?php echo $form->textField($model,'webadress_en',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gmaps_lnk'); ?>
		<?php echo $form->textField($model,'gmaps_lnk',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meetingpoint_description'); ?>
		<?php echo $form->textField($model,'meetingpoint_description',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meetingpoint_description_en'); ?>
		<?php echo $form->textField($model,'meetingpoint_description_en',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'standart_toursize'); ?>
		<?php echo $form->textField($model,'standart_toursize'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cashaccount_DTV'); ?>
		<?php echo $form->textField($model,'cashaccount_DTV',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tripadvisor_lnk'); ?>
		<?php echo $form->textField($model,'tripadvisor_lnk',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'facebook_lnk'); ?>
		<?php echo $form->textField($model,'facebook_lnk',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_analytics_id'); ?>
		<?php echo $form->textField($model,'google_analytics_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_conversions_id'); ?>
		<?php echo $form->textField($model,'google_conversions_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_conversions_label'); ?>
		<?php echo $form->textField($model,'google_conversions_label',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_analytics_id_booking_de'); ?>
		<?php echo $form->textField($model,'google_analytics_id_booking_de',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_conversions_id_booking_de'); ?>
		<?php echo $form->textField($model,'google_conversions_id_booking_de',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_conversions_label_booking_de'); ?>
		<?php echo $form->textField($model,'google_conversions_label_booking_de',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_analytics_id_booking_en'); ?>
		<?php echo $form->textField($model,'google_analytics_id_booking_en',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_conversions_id_booking_en'); ?>
		<?php echo $form->textField($model,'google_conversions_id_booking_en',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'google_conversions_label_booking_en'); ?>
		<?php echo $form->textField($model,'google_conversions_label_booking_en',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->