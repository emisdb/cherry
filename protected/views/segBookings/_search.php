<?php
/* @var $this SegBookingsController */
/* @var $model SegBookings */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_bookings'); ?>
		<?php echo $form->textField($model,'idseg_bookings'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_annotation'); ?>
		<?php echo $form->textField($model,'customer_annotation',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pay_option_id'); ?>
		<?php echo $form->textField($model,'pay_option_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isPrivate'); ?>
		<?php echo $form->textField($model,'isPrivate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'groupsize'); ?>
		<?php echo $form->textField($model,'groupsize'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sched_tourid'); ?>
		<?php echo $form->textField($model,'sched_tourid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'discounttype_id'); ?>
		<?php echo $form->textField($model,'discounttype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plusUSt'); ?>
		<?php echo $form->textField($model,'plusUSt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isPaid'); ?>
		<?php echo $form->textField($model,'isPaid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->