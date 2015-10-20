<?php
/* @var $this CurrentSubscribersController */
/* @var $model CurrentSubscribers */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'current-subscribers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_contact'); ?>
		<?php echo $form->textField($model,'id_contact'); ?>
		<?php echo $form->error($model,'id_contact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tourist'); ?>
		<?php echo $form->textField($model,'tourist'); ?>
		<?php echo $form->error($model,'tourist'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_rabatt'); ?>
		<?php echo $form->textField($model,'id_rabatt'); ?>
		<?php echo $form->error($model,'id_rabatt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_payoption'); ?>
		<?php echo $form->textField($model,'id_payoption'); ?>
		<?php echo $form->error($model,'id_payoption'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat'); ?>
		<?php echo $form->textField($model,'vat'); ?>
		<?php echo $form->error($model,'vat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textField($model,'note',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_guide'); ?>
		<?php echo $form->textField($model,'id_guide'); ?>
		<?php echo $form->error($model,'id_guide'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tour'); ?>
		<?php echo $form->textField($model,'id_tour'); ?>
		<?php echo $form->error($model,'id_tour'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_report'); ?>
		<?php echo $form->textField($model,'id_report'); ?>
		<?php echo $form->error($model,'id_report'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_zakaz'); ?>
		<?php echo $form->textField($model,'date_zakaz'); ?>
		<?php echo $form->error($model,'date_zakaz'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_report'); ?>
		<?php echo $form->textField($model,'date_report'); ?>
		<?php echo $form->error($model,'date_report'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->