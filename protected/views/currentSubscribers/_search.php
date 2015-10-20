<?php
/* @var $this CurrentSubscribersController */
/* @var $model CurrentSubscribers */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_contact'); ?>
		<?php echo $form->textField($model,'id_contact'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tourist'); ?>
		<?php echo $form->textField($model,'tourist'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_rabatt'); ?>
		<?php echo $form->textField($model,'id_rabatt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_payoption'); ?>
		<?php echo $form->textField($model,'id_payoption'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vat'); ?>
		<?php echo $form->textField($model,'vat'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'note'); ?>
		<?php echo $form->textField($model,'note',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_guide'); ?>
		<?php echo $form->textField($model,'id_guide'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tour'); ?>
		<?php echo $form->textField($model,'id_tour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_report'); ?>
		<?php echo $form->textField($model,'id_report'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_zakaz'); ?>
		<?php echo $form->textField($model,'date_zakaz'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_report'); ?>
		<?php echo $form->textField($model,'date_report'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->