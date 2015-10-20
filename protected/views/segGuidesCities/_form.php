<?php
/* @var $this SegGuidesCitiesController */
/* @var $model SegGuidesCities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-guides-cities-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->errorSummary($model); ?>

	<div class="row">
    	<?php echo $form->labelEx($model,'cities'); ?>
   
    	<?php $list = CHtml::listData( SegCities::model()->findAll(), 'idseg_cities', 'seg_cityname'); ?>
        <?php $i=0; ?>
          <?php
                $accountStatus = $list;
                echo $form->radioButtonList($model,'cities_id',$accountStatus,array('separator'=>' '));
        ?>
    
    
	</div>

	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segGuidesdata/update/id/<?php echo $id_guide;?>/id_user/<?php echo $update_user->id;?>"><?php echo 'Cancel'; ?></a></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->