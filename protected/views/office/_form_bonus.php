<?php
/* @var $this BonusController */
/* @var $model Bonus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bonus-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'val'); ?>
		<?php echo $form->textField($model,'val'); ?>
		<?php echo $form->error($model,'val'); ?>
	</div>
    <div class="row">
    	<?php echo $form->labelEx($model,'type'); ?>
    	<?php $list_type = array('euro'=>'euro', '%'=>'%'); ?>
		<?php echo $form->dropDownList($model,'type',$list_type,array('style'=>'width:80px;')); ?>
        <?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>1,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><?php echo CHtml::link("Cancel", array("bonus")) ?></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->