<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'idseg_guidesdata'); ?>
		<?php echo $form->textField($model,'idseg_guidesdata'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'base_provision'); ?>
		<?php echo $form->textField($model,'base_provision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cash_box'); ?>
		<?php echo $form->textField($model,'cash_box'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guide_shorttext'); ?>
		<?php echo $form->textField($model,'guide_shorttext',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guide_maintext'); ?>
		<?php echo $form->textField($model,'guide_maintext',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lnk_to_picture'); ?>
		<?php echo $form->textField($model,'lnk_to_picture',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest_variable'); ?>
		<?php echo $form->textField($model,'guest_variable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paysUSt'); ?>
		<?php echo $form->textField($model,'paysUSt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guestsMinforVariable'); ?>
		<?php echo $form->textField($model,'guestsMinforVariable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'taxnumber'); ?>
		<?php echo $form->textField($model,'taxnumber',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'taxoffice'); ?>
		<?php echo $form->textField($model,'taxoffice',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoiceCount2013'); ?>
		<?php echo $form->textField($model,'invoiceCount2013'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoiceCount2014'); ?>
		<?php echo $form->textField($model,'invoiceCount2014'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inVoiceCount2015'); ?>
		<?php echo $form->textField($model,'inVoiceCount2015'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voucher_cashbox'); ?>
		<?php echo $form->textField($model,'voucher_cashbox'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voucher_provision'); ?>
		<?php echo $form->textField($model,'voucher_provision'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'immediate_voucher_payment'); ?>
		<?php echo $form->textField($model,'immediate_voucher_payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guides_cashbox_account_DTV'); ?>
		<?php echo $form->textField($model,'guides_cashbox_account_DTV',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->