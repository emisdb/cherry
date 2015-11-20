<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-scheduled-tours-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tourroute_id'); ?>
		<?php echo $form->textField($model,'tourroute_id'); ?>
		<?php echo $form->error($model,'tourroute_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'openTour'); ?>
		<?php echo $form->textField($model,'openTour'); ?>
		<?php echo $form->error($model,'openTour'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TNmax_sched'); ?>
		<?php echo $form->textField($model,'TNmax_sched'); ?>
		<?php echo $form->error($model,'TNmax_sched'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration'); ?>
		<?php echo $form->error($model,'duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'starttime'); ?>
		<?php echo $form->textField($model,'starttime'); ?>
		<?php echo $form->error($model,'starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_now'); ?>
		<?php echo $form->textField($model,'date_now'); ?>
		<?php echo $form->error($model,'date_now'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'current_subscribers'); ?>
		<?php echo $form->textField($model,'current_subscribers'); ?>
		<?php echo $form->error($model,'current_subscribers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language_id'); ?>
		<?php echo $form->textField($model,'language_id'); ?>
		<?php echo $form->error($model,'language_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide1_id'); ?>
		<?php echo $form->textField($model,'guide1_id'); ?>
		<?php echo $form->error($model,'guide1_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide2_id'); ?>
		<?php echo $form->textField($model,'guide2_id'); ?>
		<?php echo $form->error($model,'guide2_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide3_id'); ?>
		<?php echo $form->textField($model,'guide3_id'); ?>
		<?php echo $form->error($model,'guide3_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide4_id'); ?>
		<?php echo $form->textField($model,'guide4_id'); ?>
		<?php echo $form->error($model,'guide4_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'original_starttime'); ?>
		<?php echo $form->textField($model,'original_starttime'); ?>
		<?php echo $form->error($model,'original_starttime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'additional_info'); ?>
		<?php echo $form->textField($model,'additional_info',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'additional_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->textField($model,'visibility'); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id'); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isInvoiced_guide1'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide1'); ?>
		<?php echo $form->error($model,'isInvoiced_guide1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isInvoiced_guide2'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide2'); ?>
		<?php echo $form->error($model,'isInvoiced_guide2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isInvoiced_guide3'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide3'); ?>
		<?php echo $form->error($model,'isInvoiced_guide3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isInvoiced_guide4'); ?>
		<?php echo $form->textField($model,'isInvoiced_guide4'); ?>
		<?php echo $form->error($model,'isInvoiced_guide4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'additional_info2'); ?>
		<?php echo $form->textField($model,'additional_info2',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'additional_info2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isCanceled'); ?>
		<?php echo $form->textField($model,'isCanceled'); ?>
		<?php echo $form->error($model,'isCanceled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancellationReason'); ?>
		<?php echo $form->textField($model,'cancellationReason',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cancellationReason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'canceledBy'); ?>
		<?php echo $form->textField($model,'canceledBy'); ?>
		<?php echo $form->error($model,'canceledBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancellationAnnotation'); ?>
		<?php echo $form->textField($model,'cancellationAnnotation',array('size'=>60,'maxlength'=>1500)); ?>
		<?php echo $form->error($model,'cancellationAnnotation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'GN_string'); ?>
		<?php echo $form->textField($model,'GN_string',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'GN_string'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->