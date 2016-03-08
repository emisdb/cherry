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


	<?php echo $form->errorSummary($model); ?>
<input required=""/>


	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>10, 'cols'=>70)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

    <div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'Schaffen' : 'Speichern'; ?></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->