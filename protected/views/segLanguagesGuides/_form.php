<?php
/* @var $this SegLanguagesGuidesController */
/* @var $model SegLanguagesGuides */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-languages-guides-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
	
		<?php echo $form->checkBox($languages_array,'0'); ?>
		
	</div>



	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segGuidesdata/update/id/<?php echo $id_guide;?>/id_user/<?php echo $update_user->id;?>"><?php echo 'Cancel'; ?></a></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->