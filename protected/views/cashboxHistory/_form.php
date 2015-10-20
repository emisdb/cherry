<?php
/* @var $this CashboxHistoryController */
/* @var $model CashboxHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cashbox-history-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'users_id'); ?>
		<?php echo $form->textField($model,'users_id'); ?>
		<?php echo $form->error($model,'users_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delta_cash'); ?>
		<?php echo $form->textField($model,'delta_cash'); ?>
		<?php echo $form->error($model,'delta_cash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
		<?php echo $form->error($model,'timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'annotation'); ?>
		<?php echo $form->textField($model,'annotation',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'annotation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approvedBy'); ?>
		<?php echo $form->textField($model,'approvedBy'); ?>
		<?php echo $form->error($model,'approvedBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cashBefore'); ?>
		<?php echo $form->textField($model,'cashBefore'); ?>
		<?php echo $form->error($model,'cashBefore'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'editedBy'); ?>
		<?php echo $form->textField($model,'editedBy'); ?>
		<?php echo $form->error($model,'editedBy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->