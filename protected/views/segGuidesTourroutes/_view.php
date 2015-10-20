<?php
/* @var $this SegGuidesTourroutesController */
/* @var $data SegGuidesTourroutes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_guides_tourroutes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_guides_tourroutes), array('view', 'id'=>$data->idseg_guides_tourroutes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('usersid')); ?>:</b>
	<?php echo CHtml::encode($data->usersid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tourroutes_id')); ?>:</b>
	<?php echo CHtml::encode($data->tourroutes_id); ?>
	<br />


</div>