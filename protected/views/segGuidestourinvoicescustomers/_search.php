<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $model SegGuidestourinvoicescustomers */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_guidesTourInvoicesCustomers'); ?>
		<?php echo $form->textField($model,'idseg_guidesTourInvoicesCustomers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tourInvoiceid'); ?>
		<?php echo $form->textField($model,'tourInvoiceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customersName'); ?>
		<?php echo $form->textField($model,'customersName',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isTourist'); ?>
		<?php echo $form->textField($model,'isTourist'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'discounttype_id'); ?>
		<?php echo $form->textField($model,'discounttype_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paymentoptionid'); ?>
		<?php echo $form->textField($model,'paymentoptionid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerInvoiceNumber'); ?>
		<?php echo $form->textField($model,'CustomerInvoiceNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cityid'); ?>
		<?php echo $form->textField($model,'cityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'KA_string'); ?>
		<?php echo $form->textField($model,'KA_string',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'isPaid'); ?>
		<?php echo $form->textField($model,'isPaid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origin_booking'); ?>
		<?php echo $form->textField($model,'origin_booking'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->