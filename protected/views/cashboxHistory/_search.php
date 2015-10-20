<?php
/* @var $this CashboxHistoryController */
/* @var $model CashboxHistory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idcashbox_history'); ?>
		<?php echo $form->textField($model,'idcashbox_history'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'users_id'); ?>
		<?php echo $form->textField($model,'users_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'delta_cash'); ?>
		<?php echo $form->textField($model,'delta_cash'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timestamp'); ?>
		<?php echo $form->textField($model,'timestamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'annotation'); ?>
		<?php echo $form->textField($model,'annotation',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approvedBy'); ?>
		<?php echo $form->textField($model,'approvedBy'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cashBefore'); ?>
		<?php echo $form->textField($model,'cashBefore'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'editedBy'); ?>
		<?php echo $form->textField($model,'editedBy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->