<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_scheduled_tours'); ?>
		<?php echo $form->textField($model,'idseg_scheduled_tours'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tourroute_id'); ?>
		<?php echo $form->textField($model,'tourroute_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'openTour'); ?>
		<?php echo $form->textField($model,'openTour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TNmax_sched'); ?>
		<?php echo $form->textField($model,'TNmax_sched'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duration'); ?>
		<?php echo $form->textField($model,'duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'starttime'); ?>
		<?php echo $form->textField($model,'starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_now'); ?>
		<?php echo $form->textField($model,'date_now'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_subscribers'); ?>
		<?php echo $form->textField($model,'current_subscribers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'language_id'); ?>
		<?php echo $form->textField($model,'language_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guide1_id'); ?>
		<?php echo $form->textField($model,'guide1_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guide2_id'); ?>
		<?php echo $form->textField($model,'guide2_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guide3_id'); ?>
		<?php echo $form->textField($model,'guide3_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guide4_id'); ?>
		<?php echo $form->textField($model,'guide4_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'original_starttime'); ?>
		<?php echo $form->textField($model,'original_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'additional_info'); ?>
		<?php echo $form->textField($model,'additional_info',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visibility'); ?>
		<?php echo $form->textField($model,'visibility'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isInvoiced_guide1'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isInvoiced_guide2'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isInvoiced_guide3'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isInvoiced_guide4'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide4'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'additional_info2'); ?>
		<?php echo $form->textField($model,'additional_info2',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isCanceled'); ?>
		<?php echo $form->textField($model,'isCanceled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancellationReason'); ?>
		<?php echo $form->textField($model,'cancellationReason',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'canceledBy'); ?>
		<?php echo $form->textField($model,'canceledBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancellationAnnotation'); ?>
		<?php echo $form->textField($model,'cancellationAnnotation',array('size'=>60,'maxlength'=>1500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GN_string'); ?>
		<?php echo $form->textField($model,'GN_string',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->