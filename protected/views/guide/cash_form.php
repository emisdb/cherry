<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cashbox-change-requests-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
 	if($model->hasErrors())
	{
		echo '<div class="callout callout-danger">'.$form->errorSummary($model).'</div>';
	}

	?>
	<div class="row">
	<div class="col-md-3">

		<?php echo $form->labelEx($model,'id_type'); ?>
	<?php echo $form->dropDownList($model,'id_type', CHtml::listData(CashboxType::model()->findAll(),'id', 'name'),array('id'=>'cashtype','onChange'=>'clickType(this.value)')); ?>
		<?php echo $form->error($model,'id_type'); ?>
		</div>
	<div class="col-md-4" id="guide_div">
		<?php echo $form->labelEx($model,'sched_user_id'); ?>
		<?php echo $form->dropDownList($model,'sched_user_id', $model->getUserOptions(),array('id'=>'guide','empty'=>'--')); ?>
		<?php echo $form->error($model,'sched_user_id'); ?>
	</div>
	<div class="col-md-5">
	</div>
	</div>

	<div class="row">
		<div class="col-md-8">
	<?php echo $form->labelEx($model,'delta_cash'); ?>
		<?php echo $form->textField($model,'delta_cash'); ?>
		<?php echo $form->error($model,'delta_cash'); ?>
	</div>
	<div class="col-md-4">
	</div>
	</div>

	<div class="row">
		<div class="col-md-8">
	<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>
	<div class="col-md-4">
	</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	window.onload = function () {
		cashtype=document.getElementById('cashtype').value;
		if(cashtype==3) document.getElementById('guide_div').style.display="block";
		else document.getElementById('guide_div').style.display="none";
  	}
	function clickType(id){
		if(id==3) document.getElementById('guide_div').style.display="block";
		else document.getElementById('guide_div').style.display="none";
	}
</script> 