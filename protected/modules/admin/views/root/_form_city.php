<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-cities-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'seg_cityname'); ?>
		<?php echo $form->textField($model,'seg_cityname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'seg_cityname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shortname'); ?>
		<?php echo $form->textField($model,'shortname',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'shortname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'segway_amount'); ?>
		<?php echo $form->textField($model,'segway_amount'); ?>
		<?php echo $form->error($model,'segway_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailInfo'); ?>
		<?php echo $form->textField($model,'mailInfo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailInfo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBuchungen'); ?>
		<?php echo $form->textField($model,'mailBuchungen',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBuchungen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBookings'); ?>
		<?php echo $form->textField($model,'mailBookings',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBookings'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailVoucher'); ?>
		<?php echo $form->textField($model,'mailVoucher',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailVoucher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailCancellation'); ?>
		<?php echo $form->textField($model,'mailCancellation',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailCancellation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailInfoDisplayName'); ?>
		<?php echo $form->textField($model,'mailInfoDisplayName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailInfoDisplayName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBuchungenDisplayName'); ?>
		<?php echo $form->textField($model,'mailBuchungenDisplayName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBuchungenDisplayName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBookingsDisplayName'); ?>
		<?php echo $form->textField($model,'mailBookingsDisplayName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBookingsDisplayName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailVoucherDisplayName'); ?>
		<?php echo $form->textField($model,'mailVoucherDisplayName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailVoucherDisplayName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailCancellationDisplayName'); ?>
		<?php echo $form->textField($model,'mailCancellationDisplayName',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailCancellationDisplayName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'webadress'); ?>
		<?php echo $form->textField($model,'webadress',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'webadress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localPhone'); ?>
		<?php echo $form->textField($model,'localPhone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'localPhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localStreet'); ?>
		<?php echo $form->textField($model,'localStreet',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'localStreet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localHouse'); ?>
		<?php echo $form->textField($model,'localHouse',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'localHouse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localPLZ'); ?>
		<?php echo $form->textField($model,'localPLZ',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'localPLZ'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailInfoAccount'); ?>
		<?php echo $form->textField($model,'mailInfoAccount',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailInfoAccount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBuchungenAccount'); ?>
		<?php echo $form->textField($model,'mailBuchungenAccount',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBuchungenAccount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBookingsAccount'); ?>
		<?php echo $form->textField($model,'mailBookingsAccount',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBookingsAccount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailVoucherAccount'); ?>
		<?php echo $form->textField($model,'mailVoucherAccount',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailVoucherAccount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailCancellationAccount'); ?>
		<?php echo $form->textField($model,'mailCancellationAccount',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailCancellationAccount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailInfoPW'); ?>
		<?php echo $form->textField($model,'mailInfoPW',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailInfoPW'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBuchungenPW'); ?>
		<?php echo $form->textField($model,'mailBuchungenPW',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBuchungenPW'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailBookingsPW'); ?>
		<?php echo $form->textField($model,'mailBookingsPW',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailBookingsPW'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailVoucherPW'); ?>
		<?php echo $form->textField($model,'mailVoucherPW',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailVoucherPW'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mailCancellationPW'); ?>
		<?php echo $form->textField($model,'mailCancellationPW',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'mailCancellationPW'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'webadress_en'); ?>
		<?php echo $form->textField($model,'webadress_en',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'webadress_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gmaps_lnk'); ?>
		<?php echo $form->textField($model,'gmaps_lnk',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'gmaps_lnk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meetingpoint_description'); ?>
		<?php echo $form->textField($model,'meetingpoint_description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'meetingpoint_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meetingpoint_description_en'); ?>
		<?php echo $form->textField($model,'meetingpoint_description_en',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'meetingpoint_description_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'standart_toursize'); ?>
		<?php echo $form->textField($model,'standart_toursize'); ?>
		<?php echo $form->error($model,'standart_toursize'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cashaccount_DTV'); ?>
		<?php echo $form->textField($model,'cashaccount_DTV',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'cashaccount_DTV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tripadvisor_lnk'); ?>
		<?php echo $form->textField($model,'tripadvisor_lnk',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tripadvisor_lnk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_lnk'); ?>
		<?php echo $form->textField($model,'facebook_lnk',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'facebook_lnk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_analytics_id'); ?>
		<?php echo $form->textField($model,'google_analytics_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'google_analytics_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_id'); ?>
		<?php echo $form->textField($model,'google_conversions_id'); ?>
		<?php echo $form->error($model,'google_conversions_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_label'); ?>
		<?php echo $form->textField($model,'google_conversions_label',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'google_conversions_label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_analytics_id_booking_de'); ?>
		<?php echo $form->textField($model,'google_analytics_id_booking_de',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_analytics_id_booking_de'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_id_booking_de'); ?>
		<?php echo $form->textField($model,'google_conversions_id_booking_de',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_id_booking_de'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_label_booking_de'); ?>
		<?php echo $form->textField($model,'google_conversions_label_booking_de',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_label_booking_de'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_analytics_id_booking_en'); ?>
		<?php echo $form->textField($model,'google_analytics_id_booking_en',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_analytics_id_booking_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_id_booking_en'); ?>
		<?php echo $form->textField($model,'google_conversions_id_booking_en',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_id_booking_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_label_booking_en'); ?>
		<?php echo $form->textField($model,'google_conversions_label_booking_en',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_label_booking_en'); ?>
	</div>


	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segCities/admin"><?php echo 'Cancel'; ?></a></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->