<?php
/* @var $this SegGuidesTourroutesController */
/* @var $model SegGuidesTourroutes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-guides-tourroutes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'usersid'); ?>
		<?php echo $form->textField($model,'usersid'); ?>
		<?php echo $form->error($model,'usersid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tourroutes_id'); ?>
		<?php echo $form->textField($model,'tourroutes_id'); ?>
		<?php echo $form->error($model,'tourroutes_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->