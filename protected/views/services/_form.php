<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'services-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'text',array('rows'=>50, 'cols'=>50, 'class'=>'span8')); ?>

    <!--<php echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>-->

    <h3>SEO</h3>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'keywords',array('class'=>'span5','maxlength'=>500)); ?>

	<hr />
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Create' : 'Behalten',
	)); ?>


<?php $this->endWidget(); ?>
