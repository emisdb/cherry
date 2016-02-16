<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
   // 'enableClientValidation' => true,
  //  'clientOptions' => array(
 //       'validateOnSubmit' => true,
 //       'validateOnChange' => true,
 //   ),
  //  'action'=>Yii::app()->createUrl($model->isNewRecord ? 'user/create' : 'user/update?id='.$model->id),
)); ?>

	<?php echo $form->errorSummary($model); ?>
    
    <div style="font-size:16px;color:#959899;">
        NUTZERINFORMATIONEN
    </div>
    <hr />
    <?php if($model->isNewRecord) {?>
   <div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'id_usergroups',array('class'=>'control-label')); ?>
		<?php $list = CHtml::listData($usergroups, 'idusergroups', 'groupname'); ?>
		<?php echo $form->dropDownList($model,'id_usergroups',$list,array( 'class'=>'form-control')); ?>
        <?php echo $form->error($model,'id_usergroups'); ?>
	</div>
	</div>
  
    <?php }?>
	<div class="row">
	<div class="form-group">
	<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	</div>

	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'new_password',array('class'=>'control-label')); ?>
		<?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>
 	</div>
    
	<div class="row"> 
	<div class="form-group">
		<?php echo $form->label($model,'new_confirm',array('class'=>'control-label')); ?> 
		<?php echo $form->passwordField($model,'new_confirm',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'new_confirm'); ?>
	</div>
	</div>

	<div class="row">
	<div class="form-group">
		<?php echo $form->labelEx($model,'profile',array('class'=>'control-label')); ?>
		<?php echo $form->textArea($model,'profile',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'profile'); ?>
	</div>
	</div>

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Speichern'; ?></button>
        <?php if($model->id != Yii::app()->user->id) {?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>admin"><?php echo 'Abbrechen'; ?></a></button>
        <?php }else{?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>profile"><?php echo 'Abbrechen'; ?></a></button>
        <?php }?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->