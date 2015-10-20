<?php
/* @var $this SegBookingsController */
/* @var $model SegBookings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-bookings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_annotation'); ?>
		<?php echo $form->textField($model,'customer_annotation',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'customer_annotation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pay_option_id'); ?>
		<?php echo $form->textField($model,'pay_option_id'); ?>
		<?php echo $form->error($model,'pay_option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isPrivate'); ?>
		<?php echo $form->textField($model,'isPrivate'); ?>
		<?php echo $form->error($model,'isPrivate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groupsize'); ?>
		<?php echo $form->textField($model,'groupsize'); ?>
		<?php echo $form->error($model,'groupsize'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sched_tourid'); ?>
		<?php echo $form->textField($model,'sched_tourid'); ?>
		<?php echo $form->error($model,'sched_tourid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discounttype_id'); ?>
		<?php echo $form->textField($model,'discounttype_id'); ?>
		<?php echo $form->error($model,'discounttype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plusUSt'); ?>
		<?php echo $form->textField($model,'plusUSt'); ?>
		<?php echo $form->error($model,'plusUSt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isPaid'); ?>
		<?php echo $form->textField($model,'isPaid'); ?>
		<?php echo $form->error($model,'isPaid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->