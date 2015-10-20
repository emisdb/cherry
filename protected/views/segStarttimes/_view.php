<?php
/* @var $this SegStarttimesController */
/* @var $data SegStarttimes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_starttimes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_starttimes), array('view', 'id'=>$data->idseg_starttimes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timevalue')); ?>:</b>
	<?php echo CHtml::encode($data->timevalue); ?>
	<br />


</div>