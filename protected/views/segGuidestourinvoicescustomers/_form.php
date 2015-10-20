<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $model SegGuidestourinvoicescustomers */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-guidestourinvoicescustomers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tourInvoiceid'); ?>
		<?php echo $form->textField($model,'tourInvoiceid'); ?>
		<?php echo $form->error($model,'tourInvoiceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customersName'); ?>
		<?php echo $form->textField($model,'customersName',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'customersName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isTourist'); ?>
		<?php echo $form->textField($model,'isTourist'); ?>
		<?php echo $form->error($model,'isTourist'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discounttype_id'); ?>
		<?php echo $form->textField($model,'discounttype_id'); ?>
		<?php echo $form->error($model,'discounttype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paymentoptionid'); ?>
		<?php echo $form->textField($model,'paymentoptionid'); ?>
		<?php echo $form->error($model,'paymentoptionid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerInvoiceNumber'); ?>
		<?php echo $form->textField($model,'CustomerInvoiceNumber'); ?>
		<?php echo $form->error($model,'CustomerInvoiceNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cityid'); ?>
		<?php echo $form->textField($model,'cityid'); ?>
		<?php echo $form->error($model,'cityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'KA_string'); ?>
		<?php echo $form->textField($model,'KA_string',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'KA_string'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isPaid'); ?>
		<?php echo $form->textField($model,'isPaid'); ?>
		<?php echo $form->error($model,'isPaid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origin_booking'); ?>
		<?php echo $form->textField($model,'origin_booking'); ?>
		<?php echo $form->error($model,'origin_booking'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->