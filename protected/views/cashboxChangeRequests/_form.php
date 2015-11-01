<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cashbox-change-requests-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_users'); ?>
		<?php echo $form->textField($model,'id_users'); ?>
		<?php echo $form->error($model,'id_users'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_type'); ?>
		<?php echo $form->textField($model,'id_type'); ?>
		<?php echo $form->error($model,'id_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delta_cash'); ?>
		<?php echo $form->textField($model,'delta_cash'); ?>
		<?php echo $form->error($model,'delta_cash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>1500)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isApproved'); ?>
		<?php echo $form->textField($model,'isApproved'); ?>
		<?php echo $form->error($model,'isApproved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approvedBy'); ?>
		<?php echo $form->textField($model,'approvedBy'); ?>
		<?php echo $form->error($model,'approvedBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'request_date'); ?>
		<?php echo $form->textField($model,'request_date'); ?>
		<?php echo $form->error($model,'request_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_date'); ?>
		<?php echo $form->textField($model,'approval_date'); ?>
		<?php echo $form->error($model,'approval_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->