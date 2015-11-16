<?php
/* @var $this SegContactsController */
/* @var $model SegContacts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-contacts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'additional_address'); ?>
		<?php echo $form->textField($model,'additional_address',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'additional_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postalcode'); ?>
		<?php echo $form->textField($model,'postalcode',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'postalcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'house'); ?>
		<?php echo $form->textField($model,'house',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'house'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthdate'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'attribute' => 'birthdate',
            'model' => $model,
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat' => 'dd.mm.yy',
                'yearRange' => '1950:2015',
                'changeMonth' => true,
                'changeYear' => true,
                // 'minDate' => '01.06.2015',//0, 
                // 'defaultDate'=> time(),     
                 //'maxDate' => '2099-12-31',  
                // 'onSelect'=> 'js: function(date) {if(date != "") { 
                //    window.location.href = "'.CHtml::encode($this->createUrl('segScheduledtours/weeks'
                //    )).'/date/"+date ;
                // } }',
            ),
            'htmlOptions'=>array(
                //'style'=>'color:red;'
            ),
            //'flat'=>true,
        )); ?>
       
		<?php echo $form->error($model,'birthdate'); ?>
	</div>

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
        <?php if($model->idcontacts != Yii::app()->user->id) {?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/update/id/<?php echo $id_user;?>"><?php echo 'Cancel'; ?></a></button>
        <?php }else{?>
            <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/profile"><?php echo 'Cancel'; ?></a></button>
        <?php }?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->