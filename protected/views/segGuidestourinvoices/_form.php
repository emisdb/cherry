<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $model SegGuidestourinvoices */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-guidestourinvoices-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'creationDate'); ?>
		<?php echo $form->textField($model,'creationDate'); ?>
		<?php echo $form->error($model,'creationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cityid'); ?>
		<?php echo $form->textField($model,'cityid'); ?>
		<?php echo $form->error($model,'cityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sched_tourid'); ?>
		<?php echo $form->textField($model,'sched_tourid'); ?>
		<?php echo $form->error($model,'sched_tourid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guideNr'); ?>
		<?php echo $form->textField($model,'guideNr'); ?>
		<?php echo $form->error($model,'guideNr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'overAllIncome'); ?>
		<?php echo $form->textField($model,'overAllIncome'); ?>
		<?php echo $form->error($model,'overAllIncome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cashIncome'); ?>
		<?php echo $form->textField($model,'cashIncome'); ?>
		<?php echo $form->error($model,'cashIncome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'InvoiceNumber'); ?>
		<?php echo $form->textField($model,'InvoiceNumber'); ?>
		<?php echo $form->error($model,'InvoiceNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TA_string'); ?>
		<?php echo $form->textField($model,'TA_string',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'TA_string'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->