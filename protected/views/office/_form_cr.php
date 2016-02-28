<?php
/* @var $this CancellationReasonController */
/* @var $model CancellationReason */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cancellation-reason-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Felder mit einem <span class="required">*</span> müssen ausgefüllt werden.</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<div class="col-md-4">
			<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200,'class'=>"form-control")); ?>
		<?php echo $form->error($model,'name'); ?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="form-group">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'value'); ?>
			</div>
		</div>
	</div>

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'Erstellen' : 'Speichern'; ?></button>
	<button class="btn btn-primary cancel"><?php echo CHtml::link("Abbrechen", array("cr")) ?></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->