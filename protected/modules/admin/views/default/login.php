<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div style="text-align: center; width:100%;">
<?php echo CHtml::image(Yii::app()->request->baseUrl."/img/cherrytours_icon_colour_rgb.jpg","User Image",array("class"=>"img-circle")) ?>

</div> 
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>


	<div class="row submit">
        <button class="btn btn-primary" type="submit"><?php echo 'Enter'; ?></button>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
