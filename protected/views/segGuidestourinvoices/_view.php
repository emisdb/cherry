<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $data SegGuidestourinvoices */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_guidesTourInvoices')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_guidesTourInvoices), array('view', 'id'=>$data->idseg_guidesTourInvoices)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creationDate')); ?>:</b>
	<?php echo CHtml::encode($data->creationDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cityid')); ?>:</b>
	<?php echo CHtml::encode($data->cityid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sched_tourid')); ?>:</b>
	<?php echo CHtml::encode($data->sched_tourid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guideNr')); ?>:</b>
	<?php echo CHtml::encode($data->guideNr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('overAllIncome')); ?>:</b>
	<?php echo CHtml::encode($data->overAllIncome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cashIncome')); ?>:</b>
	<?php echo CHtml::encode($data->cashIncome); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('InvoiceNumber')); ?>:</b>
	<?php echo CHtml::encode($data->InvoiceNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TA_string')); ?>:</b>
	<?php echo CHtml::encode($data->TA_string); ?>
	<br />

	*/ ?>

</div>