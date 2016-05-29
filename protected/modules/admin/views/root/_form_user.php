<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

     <div class="box box-primary" >
        <div class="box-header with-border">
            <h4 class="box-title">
           NUTZERINFORMATIONEN
            </h4>
        </div>
        <div class="box-body" >
    <div class="row">
   <?php if($model->isNewRecord) {?>
		<div class="col-md-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'id_usergroups',array('class'=>'control-label')); ?>
		<?php $list = CHtml::listData($usergroups, 'idusergroups', 'groupname'); 
		echo $form->dropDownList($model,'id_usergroups',$list,array( 'class'=>'form-control')); ?>
        <?php echo $form->error($model,'id_usergroups'); ?>
	</div>
	</div>
     <?php } ?>
		<div class="col-md-6">
	<div class="form-group">
	<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	</div>
	</div>

	<div class="row">
		<div class="col-md-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'new_password',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>
 	</div>
  		<div class="col-md-6">
  
	<div class="form-group">
		<?php echo $form->label($model,'new_confirm',array('class'=>'control-label')); ?> 
		<?php echo $form->passwordField($model,'new_confirm',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'new_confirm'); ?>
	</div>
	</div>

	</div>

	<div class="row">
 		<div class="col-md-12">
 	<div class="form-group">
		<?php echo $form->labelEx($model,'profile',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'profile',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'profile'); ?>
	</div>
	</div>
	</div>
	</div>
    </div>