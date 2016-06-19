<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-scheduled-tours-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'starttime'); ?>
		<?php echo $form->textField($model,'starttime'); ?>
		<?php echo $form->error($model,'starttime'); ?>
	</div>
	<div class="row">
    	<?php echo $form->labelEx($model,'language_ob'); ?>
     	<?php $list_l = CHtml::listData($languages_guide, 'id_languages', 'englishname'); ?>
        <?php echo $form->dropDownList($model,'language_ob',$list_l); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_ob'); ?>
        <?php $list_g = CHtml::listData($guide_list, 'id', 'username'); ?>
 		 <?php echo $form->dropDownList($model,'user_ob',$list_g); ?>
	</div>



	

	<div class="row buttons">
      	<button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segScheduledTours/officeadmin"><?php echo 'Cancel'; ?></a></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->