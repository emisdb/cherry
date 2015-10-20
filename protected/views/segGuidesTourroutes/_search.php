<?php
/* @var $this SegGuidesTourroutesController */
/* @var $model SegGuidesTourroutes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_guides_tourroutes'); ?>
		<?php echo $form->textField($model,'idseg_guides_tourroutes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'usersid'); ?>
		<?php echo $form->textField($model,'usersid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tourroutes_id'); ?>
		<?php echo $form->textField($model,'tourroutes_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->