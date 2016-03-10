<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-tourroutes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tour_categories'); ?>
		<?php echo $form->textField($model,'id_tour_categories'); ?>
		<?php echo $form->error($model,'id_tour_categories'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maintext'); ?>
		<?php echo $form->textField($model,'maintext',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'maintext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maintext_en'); ?>
		<?php echo $form->textField($model,'maintext_en',array('size'=>60,'maxlength'=>2000)); ?>
		<?php echo $form->error($model,'maintext_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shorttext'); ?>
		<?php echo $form->textField($model,'shorttext',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shorttext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shorttext_en'); ?>
		<?php echo $form->textField($model,'shorttext_en',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shorttext_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gmaps_lnk'); ?>
		<?php echo $form->textArea($model,'gmaps_lnk',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'gmaps_lnk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meetingpoint_description'); ?>
		<?php echo $form->textField($model,'meetingpoint_description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'meetingpoint_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meetingpoint_description_en'); ?>
		<?php echo $form->textField($model,'meetingpoint_description_en',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'meetingpoint_description_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TNmin'); ?>
		<?php echo $form->textField($model,'TNmin'); ?>
		<?php echo $form->error($model,'TNmin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TNmax'); ?>
		<?php echo $form->textField($model,'TNmax'); ?>
		<?php echo $form->error($model,'TNmax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inDevelopment'); ?>
		<?php echo $form->textField($model,'inDevelopment'); ?>
		<?php echo $form->error($model,'inDevelopment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'route_bigpic'); ?>
		<?php echo $form->textField($model,'route_bigpic',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'route_bigpic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'route_pic'); ?>
		<?php echo $form->textField($model,'route_pic',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'route_pic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pic_icon'); ?>
		<?php echo $form->textField($model,'pic_icon',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pic_icon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pdf_path'); ?>
		<?php echo $form->textField($model,'pdf_path',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'pdf_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'base_price'); ?>
		<?php echo $form->textField($model,'base_price'); ?>
		<?php echo $form->error($model,'base_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'standard_duration'); ?>
		<?php echo $form->textField($model,'standard_duration'); ?>
		<?php echo $form->error($model,'standard_duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cityid'); ?>
		<?php echo $form->textField($model,'cityid'); ?>
		<?php echo $form->error($model,'cityid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->