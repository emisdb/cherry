<?php
/* @var $this MainoptionsController */
/* @var $model Mainoptions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mainoptions-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
    <div class="row buttons">
      	<button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New option' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>moadmin"><?php echo 'Cancel'; ?></a></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->