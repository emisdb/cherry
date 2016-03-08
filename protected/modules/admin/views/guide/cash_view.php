<?php
/* @var $this CashboxChangeRequestsController */
/* @var $data CashboxChangeRequests */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcashbox_change_requests')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcashbox_change_requests), array('view', 'id'=>$data->idcashbox_change_requests)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_type')); ?>:</b>
	<?php echo CHtml::encode($data->cashtype->name); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('request_date')); ?>:</b>
	<?php echo CHtml::encode($data->request_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delta_cash')); ?>:</b>
	<?php echo CHtml::encode($data->delta_cash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reason')); ?>:</b>
	<?php echo CHtml::encode($data->reason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approvedBy')); ?>:</b>
	<?php  echo (isset($data->apuser))?  CHtml::encode($data->apuser->contact_ob->firstname. " ".$data->apuser->contact_ob->surname): "<span style='color:#f00;'>No</span>"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_date')); ?>:</b>
	<?php echo CHtml::encode($data->approval_date); ?>
	<br />


</div>