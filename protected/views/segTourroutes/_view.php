<?php
/* @var $this SegTourroutesController */
/* @var $data SegTourroutes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_tourroutes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_tourroutes), array('view', 'id'=>$data->idseg_tourroutes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tour_categories')); ?>:</b>
	<?php echo CHtml::encode($data->id_tour_categories); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maintext')); ?>:</b>
	<?php echo CHtml::encode($data->maintext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maintext_en')); ?>:</b>
	<?php echo CHtml::encode($data->maintext_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shorttext')); ?>:</b>
	<?php echo CHtml::encode($data->shorttext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shorttext_en')); ?>:</b>
	<?php echo CHtml::encode($data->shorttext_en); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gmaps_lnk')); ?>:</b>
	<?php echo CHtml::encode($data->gmaps_lnk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meetingpoint_description')); ?>:</b>
	<?php echo CHtml::encode($data->meetingpoint_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meetingpoint_description_en')); ?>:</b>
	<?php echo CHtml::encode($data->meetingpoint_description_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TNmin')); ?>:</b>
	<?php echo CHtml::encode($data->TNmin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TNmax')); ?>:</b>
	<?php echo CHtml::encode($data->TNmax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inDevelopment')); ?>:</b>
	<?php echo CHtml::encode($data->inDevelopment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('route_bigpic')); ?>:</b>
	<?php echo CHtml::encode($data->route_bigpic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('route_pic')); ?>:</b>
	<?php echo CHtml::encode($data->route_pic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_icon')); ?>:</b>
	<?php echo CHtml::encode($data->pic_icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pdf_path')); ?>:</b>
	<?php echo CHtml::encode($data->pdf_path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('base_price')); ?>:</b>
	<?php echo CHtml::encode($data->base_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('standard_duration')); ?>:</b>
	<?php echo CHtml::encode($data->standard_duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cityid')); ?>:</b>
	<?php echo CHtml::encode($data->cityid); ?>
	<br />

	*/ ?>

</div>