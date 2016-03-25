<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-guidesdata-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'base_provision'); ?>
		<?php echo $form->textField($model,'base_provision'); ?>
		<?php echo $form->error($model,'base_provision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cash_box'); ?>
		<?php echo $form->textField($model,'cash_box'); ?>
		<?php echo $form->error($model,'cash_box'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide_shorttext'); ?>
		<?php echo $form->textField($model,'guide_shorttext',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'guide_shorttext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide_shorttext_En'); ?>
		<?php echo $form->textField($model,'guide_shorttext_En',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'guide_shorttext_En'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide_maintext'); ?>
		<?php echo $form->textField($model,'guide_maintext',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'guide_maintext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guide_maintext_En'); ?>
		<?php echo $form->textField($model,'guide_maintext_En',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'guide_maintext_En'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lnk_to_picture'); ?>
		<?php echo $form->textField($model,'lnk_to_picture',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'lnk_to_picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lnk_to_license'); ?>
		<?php echo $form->textField($model,'lnk_to_license',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'lnk_to_license'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guest_variable'); ?>
		<?php echo $form->textField($model,'guest_variable'); ?>
		<?php echo $form->error($model,'guest_variable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paysUSt'); ?>
		<?php echo $form->textField($model,'paysUSt'); ?>
		<?php echo $form->error($model,'paysUSt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guestsMinforVariable'); ?>
		<?php echo $form->textField($model,'guestsMinforVariable'); ?>
		<?php echo $form->error($model,'guestsMinforVariable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taxnumber'); ?>
		<?php echo $form->textField($model,'taxnumber',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'taxnumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'taxoffice'); ?>
		<?php echo $form->textField($model,'taxoffice',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'taxoffice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoiceCount2013'); ?>
		<?php echo $form->textField($model,'invoiceCount2013'); ?>
		<?php echo $form->error($model,'invoiceCount2013'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoiceCount2014'); ?>
		<?php echo $form->textField($model,'invoiceCount2014'); ?>
		<?php echo $form->error($model,'invoiceCount2014'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inVoiceCount2015'); ?>
		<?php echo $form->textField($model,'inVoiceCount2015'); ?>
		<?php echo $form->error($model,'inVoiceCount2015'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voucher_cashbox'); ?>
		<?php echo $form->textField($model,'voucher_cashbox'); ?>
		<?php echo $form->error($model,'voucher_cashbox'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'voucher_provision'); ?>
		<?php echo $form->textField($model,'voucher_provision'); ?>
		<?php echo $form->error($model,'voucher_provision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'immediate_voucher_payment'); ?>
		<?php echo $form->textField($model,'immediate_voucher_payment'); ?>
		<?php echo $form->error($model,'immediate_voucher_payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guides_cashbox_account_DTV'); ?>
		<?php echo $form->textField($model,'guides_cashbox_account_DTV',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'guides_cashbox_account_DTV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BIC'); ?>
		<?php echo $form->textField($model,'BIC',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'BIC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IBAN'); ?>
		<?php echo $form->textField($model,'IBAN',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'IBAN'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->