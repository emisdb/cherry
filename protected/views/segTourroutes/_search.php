<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_tourroutes'); ?>
		<?php echo $form->textField($model,'idseg_tourroutes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tour_categories'); ?>
		<?php echo $form->textField($model,'id_tour_categories'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maintext'); ?>
		<?php echo $form->textField($model,'maintext',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maintext_en'); ?>
		<?php echo $form->textField($model,'maintext_en',array('size'=>60,'maxlength'=>2000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shorttext'); ?>
		<?php echo $form->textField($model,'shorttext',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shorttext_en'); ?>
		<?php echo $form->textField($model,'shorttext_en',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gmaps_lnk'); ?>
		<?php echo $form->textArea($model,'gmaps_lnk',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meetingpoint_description'); ?>
		<?php echo $form->textField($model,'meetingpoint_description',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'meetingpoint_description_en'); ?>
		<?php echo $form->textField($model,'meetingpoint_description_en',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TNmin'); ?>
		<?php echo $form->textField($model,'TNmin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TNmax'); ?>
		<?php echo $form->textField($model,'TNmax'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inDevelopment'); ?>
		<?php echo $form->textField($model,'inDevelopment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'route_bigpic'); ?>
		<?php echo $form->textField($model,'route_bigpic',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'route_pic'); ?>
		<?php echo $form->textField($model,'route_pic',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pic_icon'); ?>
		<?php echo $form->textField($model,'pic_icon',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pdf_path'); ?>
		<?php echo $form->textField($model,'pdf_path',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'base_price'); ?>
		<?php echo $form->textField($model,'base_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'standard_duration'); ?>
		<?php echo $form->textField($model,'standard_duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cityid'); ?>
		<?php echo $form->textField($model,'cityid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->