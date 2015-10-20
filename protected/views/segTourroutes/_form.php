<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-tourroutes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php $list = CHtml::listData(SegCities::model()->findAll(), 'idseg_cities', 'seg_cityname'); ?>
		<?php echo $form->dropDownList($model,'city',$list,array('empty' => '')); ?>
        <?php echo $form->error($model,'city'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'tour_categories'); ?>
		<?php $list = CHtml::listData(TourCategories::model()->findAll(), 'id_tour_categories', 'name'); ?>
		<?php echo $form->dropDownList($model,'tour_categories',$list,array('empty' => '')); ?>
        <?php echo $form->error($model,'tour_categories'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'maintext'); ?>
        <?php echo $form->textArea($model,'maintext',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'maintext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shorttext'); ?>
        <?php echo $form->textArea($model,'shorttext',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'shorttext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TNmin'); ?>
		<?php echo $form->textField($model,'TNmin'); ?>
		<?php echo $form->error($model,'TNmin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TNmax'); ?>
		<?php echo $form->textField($model,'TNmax'); ?>
		<?php echo $form->error($model,'TNmax'); ?>
	</div>

<!--	<div class="row">
		<php echo $form->labelEx($model,'inDevelopment'); ?>
		<php echo $form->textField($model,'inDevelopment'); ?>
		<php echo $form->error($model,'inDevelopment'); ?>
	</div>-->

	<!--<div class="row">
		<php echo $form->labelEx($model,'route_bigpic'); ?>
        <php echo $form->FileField($model,'image_big');?>
		<php echo $form->error($model,'route_bigpic'); ?>
	</div> 
    <php if($model->route_bigpic !=""){
    ?>
        <div class="row">
            <img src="<php echo Yii::app()->request->baseUrl; ?>/image/tours/<php echo $model->route_bigpic;?>" />
        </div>
    <php }?> 
    
   	<div class="row">
		<php echo $form->labelEx($model,'route_pic'); ?>
        <php echo $form->FileField($model,'image');?>
		<php echo $form->error($model,'route_pic'); ?>
	</div> 
    <php if($model->route_pic !=""){
    ?>
        <div class="row">
            <img src="<php echo Yii::app()->request->baseUrl; ?>/image/tours/<?php echo $model->route_pic;?>" />
        </div>
    <php }?> 
    -->
    
   	<div class="row">
		<?php echo $form->labelEx($model,'pic_icon'); ?>
        <?php echo $form->FileField($model,'image_icon');?>
		<?php echo $form->error($model,'pic_icon'); ?>
	</div> 
    <?php if($model->pic_icon !=""){
    ?>
        <div class="row">
            <?php echo $model->pic_icon;?>
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/image/tours/<?php echo $model->pic_icon;?>" width="100px"/>
        </div>
    <?php }?> 

	<!--<div class="row">
		<php echo $form->labelEx($model,'route_bigpic'); ?>
		<php echo $form->textField($model,'route_bigpic',array('size'=>45,'maxlength'=>45)); ?>
		<php echo $form->error($model,'route_bigpic'); ?>
	</div>

	<div class="row">
		<php echo $form->labelEx($model,'route_pic'); ?>
		<php echo $form->textField($model,'route_pic',array('size'=>45,'maxlength'=>45)); ?>
		<php echo $form->error($model,'route_pic'); ?>
	</div>

	<div class="row">
		<php echo $form->labelEx($model,'pic_icon'); ?>
		<php echo $form->textField($model,'pic_icon',array('size'=>45,'maxlength'=>45)); ?>
		<php echo $form->error($model,'pic_icon'); ?>
	</div>
    -->
   	<div class="row">
		<?php echo $form->labelEx($model,'pdf_path'); ?>
        <?php echo $form->FileField($model,'pdf_file');?>
		<?php echo $form->error($model,'pdf_path'); ?>
	</div> 
    <?php if($model->pdf_path !=""){
    ?>
        <div class="row">
            <?php echo $model->pdf_path;?>
        </div>
    <?php }?> 
    
	<!--<div class="row">
		<php echo $form->labelEx($model,'pdf_path'); ?>
		<php echo $form->textField($model,'pdf_path',array('size'=>45,'maxlength'=>45)); ?>
		<php echo $form->error($model,'pdf_path'); ?>
	</div>
    -->

	<div class="row">
		<?php echo $form->labelEx($model,'base_price'); ?>
		<?php echo $form->textField($model,'base_price'); ?>
		<?php echo $form->error($model,'base_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'standard_duration'); ?>
		<?php echo $form->textField($model,'standard_duration'); ?>
		<?php echo $form->error($model,'standard_duration'); ?>
	</div>

<!--	<div class="row">
		<php echo $form->labelEx($model,'cityid'); ?>
		<php echo $form->textField($model,'cityid'); ?>
		<php echo $form->error($model,'cityid'); ?>
	</div>-->

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/SegTourroutes/admin"><?php echo 'Cancel'; ?></a></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->