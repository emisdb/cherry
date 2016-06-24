<?php
/* @var $this MainController */
/* @var $model Main */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'main-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            <div class="col-md-6">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
           </div>
            <div class="col-md-6">
		<?php echo $form->labelEx($model,'status',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
           </div>
 	</div>

	<div class="row">
            <div class="col-md-12">
            	<?php echo $form->labelEx($model,'text',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>16, 'cols'=>200,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'text'); ?>
        </div>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->