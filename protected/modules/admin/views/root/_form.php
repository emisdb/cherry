<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
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
        PROFILE INFORMATION
    </div>
    <hr />
    <?php if($model->isNewRecord) {?>
    <div class="row">
		<?php echo $form->labelEx($model,'role_ob'); ?>
		<?php $list = CHtml::listData($usergroups, 'idusergroups', 'groupname'); ?>
		<?php echo $form->dropDownList($model,'role_ob',$list,array('empty' => '')); ?>
        <?php echo $form->error($model,'role_ob'); ?>
	</div>
  
    <?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'new_password'); ?>
	</div>
    
	<div class="row"> 
		<?php echo $form->label($model,'new_confirm'); ?> 
		<?php echo $form->passwordField($model,'new_confirm',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'new_confirm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profile'); ?>
		<?php echo $form->textArea($model,'profile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'profile'); ?>
	</div>

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <?php if($model->id != Yii::app()->user->id) {?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/admin"><?php echo 'Cancel'; ?></a></button>
        <?php }else{?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/profile"><?php echo 'Cancel'; ?></a></button>
        <?php }?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->