<?php
/* @var $this SegGuidesCitiesController */
/* @var $data SegGuidesCities */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_guides_cities')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_guides_cities), array('view', 'id'=>$data->idseg_guides_cities)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('users_id')); ?>:</b>
	<?php echo CHtml::encode($data->users_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cities_id')); ?>:</b>
	<?php echo CHtml::encode($data->cities_id); ?>
	<br />


</div>