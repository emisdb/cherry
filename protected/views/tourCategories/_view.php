<?php
/* @var $this TourCategoriesController */
/* @var $data TourCategories */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tour_categories')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_tour_categories), array('view', 'id'=>$data->id_tour_categories)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>