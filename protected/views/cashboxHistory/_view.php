<?php
/* @var $this CashboxHistoryController */
/* @var $data CashboxHistory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcashbox_history')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcashbox_history), array('view', 'id'=>$data->idcashbox_history)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('users_id')); ?>:</b>
	<?php echo CHtml::encode($data->users_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delta_cash')); ?>:</b>
	<?php echo CHtml::encode($data->delta_cash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('annotation')); ?>:</b>
	<?php echo CHtml::encode($data->annotation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approvedBy')); ?>:</b>
	<?php echo CHtml::encode($data->approvedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cashBefore')); ?>:</b>
	<?php echo CHtml::encode($data->cashBefore); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('editedBy')); ?>:</b>
	<?php echo CHtml::encode($data->editedBy); ?>
	<br />

	*/ ?>

</div>