<?php
/* @var $this SegBookingsController */
/* @var $data SegBookings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_bookings')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_bookings), array('view', 'id'=>$data->idseg_bookings)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_annotation')); ?>:</b>
	<?php echo CHtml::encode($data->customer_annotation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pay_option_id')); ?>:</b>
	<?php echo CHtml::encode($data->pay_option_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isPrivate')); ?>:</b>
	<?php echo CHtml::encode($data->isPrivate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupsize')); ?>:</b>
	<?php echo CHtml::encode($data->groupsize); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sched_tourid')); ?>:</b>
	<?php echo CHtml::encode($data->sched_tourid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discounttype_id')); ?>:</b>
	<?php echo CHtml::encode($data->discounttype_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plusUSt')); ?>:</b>
	<?php echo CHtml::encode($data->plusUSt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isPaid')); ?>:</b>
	<?php echo CHtml::encode($data->isPaid); ?>
	<br />

	*/ ?>

</div>