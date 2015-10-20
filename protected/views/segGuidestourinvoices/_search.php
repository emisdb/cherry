<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $model SegGuidestourinvoices */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_guidesTourInvoices'); ?>
		<?php echo $form->textField($model,'idseg_guidesTourInvoices'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creationDate'); ?>
		<?php echo $form->textField($model,'creationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cityid'); ?>
		<?php echo $form->textField($model,'cityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sched_tourid'); ?>
		<?php echo $form->textField($model,'sched_tourid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guideNr'); ?>
		<?php echo $form->textField($model,'guideNr'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'overAllIncome'); ?>
		<?php echo $form->textField($model,'overAllIncome'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cashIncome'); ?>
		<?php echo $form->textField($model,'cashIncome'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'InvoiceNumber'); ?>
		<?php echo $form->textField($model,'InvoiceNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TA_string'); ?>
		<?php echo $form->textField($model,'TA_string',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->