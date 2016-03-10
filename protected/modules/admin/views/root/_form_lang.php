<?php
/* @var $this LanguagesController */
/* @var $model Languages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'languages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'shortname'); ?>
		<?php echo $form->textField($model,'shortname',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'shortname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'germanname'); ?>
		<?php echo $form->textField($model,'germanname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'germanname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'englishname'); ?>
		<?php echo $form->textField($model,'englishname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'englishname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flagpic'); ?>
		<?php echo $form->textField($model,'flagpic',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'flagpic'); ?>
	</div>

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>ladmin"><?php echo 'Cancel'; ?></a></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->