<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idcashbox_change_requests'); ?>
		<?php echo $form->textField($model,'idcashbox_change_requests'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_users'); ?>
		<?php echo $form->textField($model,'id_users'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_type'); ?>
		<?php echo $form->textField($model,'id_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'delta_cash'); ?>
		<?php echo $form->textField($model,'delta_cash'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approvedBy'); ?>
		<?php echo $form->textField($model,'approvedBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_date'); ?>
		<?php echo $form->textField($model,'request_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approval_date'); ?>
		<?php echo $form->textField($model,'approval_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->