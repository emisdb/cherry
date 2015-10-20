<?php
/* @var $this UsergroupsController */
/* @var $model Usergroups */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idusergroups'); ?>
		<?php echo $form->textField($model,'idusergroups'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'groupname'); ?>
		<?php echo $form->textField($model,'groupname',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->