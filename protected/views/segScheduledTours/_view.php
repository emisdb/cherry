<?php
/* @var $this SegScheduledToursController */
/* @var $data SegScheduledTours */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_scheduled_tours')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_scheduled_tours), array('view', 'id'=>$data->idseg_scheduled_tours)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tourroute_id')); ?>:</b>
	<?php echo CHtml::encode($data->tourroute_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('openTour')); ?>:</b>
	<?php echo CHtml::encode($data->openTour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TNmax_sched')); ?>:</b>
	<?php echo CHtml::encode($data->TNmax_sched); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('starttime')); ?>:</b>
	<?php echo CHtml::encode($data->starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('current_subscribers')); ?>:</b>
	<?php echo CHtml::encode($data->current_subscribers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	<?php echo CHtml::encode($data->language_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide1_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide1_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide2_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide2_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide3_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide3_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide4_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide4_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('original_starttime')); ?>:</b>
	<?php echo CHtml::encode($data->original_starttime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_info')); ?>:</b>
	<?php echo CHtml::encode($data->additional_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visibility')); ?>:</b>
	<?php echo CHtml::encode($data->visibility); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide1')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide2')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide3')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide4')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_info2')); ?>:</b>
	<?php echo CHtml::encode($data->additional_info2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isCanceled')); ?>:</b>
	<?php echo CHtml::encode($data->isCanceled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancellationReason')); ?>:</b>
	<?php echo CHtml::encode($data->cancellationReason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('canceledBy')); ?>:</b>
	<?php echo CHtml::encode($data->canceledBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancellationAnnotation')); ?>:</b>
	<?php echo CHtml::encode($data->cancellationAnnotation); ?>
	<br />

	*/ ?>

</div>