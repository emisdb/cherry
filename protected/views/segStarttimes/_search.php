<?php
/* @var $this SegStarttimesController */
/* @var $model SegStarttimes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_starttimes'); ?>
		<?php echo $form->textField($model,'idseg_starttimes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timevalue'); ?>
		<?php echo $form->textField($model,'timevalue'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->