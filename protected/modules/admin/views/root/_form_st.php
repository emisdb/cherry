<?php
/* @var $this SegStarttimesController */
/* @var $model SegStarttimes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-starttimes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'timevalue'); ?>
		<?php echo $form->textField($model,'timevalue'); ?>
		<?php echo $form->error($model,'timevalue'); ?>
	</div>


	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'Save' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segStartTimes/admin"><?php echo 'Cancel'; ?></a></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->