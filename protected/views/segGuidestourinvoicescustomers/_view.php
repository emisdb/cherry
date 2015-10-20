<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $data SegGuidestourinvoicescustomers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_guidesTourInvoicesCustomers')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_guidesTourInvoicesCustomers), array('view', 'id'=>$data->idseg_guidesTourInvoicesCustomers)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tourInvoiceid')); ?>:</b>
	<?php echo CHtml::encode($data->tourInvoiceid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customersName')); ?>:</b>
	<?php echo CHtml::encode($data->customersName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isTourist')); ?>:</b>
	<?php echo CHtml::encode($data->isTourist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discounttype_id')); ?>:</b>
	<?php echo CHtml::encode($data->discounttype_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentoptionid')); ?>:</b>
	<?php echo CHtml::encode($data->paymentoptionid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerInvoiceNumber')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerInvoiceNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cityid')); ?>:</b>
	<?php echo CHtml::encode($data->cityid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('KA_string')); ?>:</b>
	<?php echo CHtml::encode($data->KA_string); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isPaid')); ?>:</b>
	<?php echo CHtml::encode($data->isPaid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origin_booking')); ?>:</b>
	<?php echo CHtml::encode($data->origin_booking); ?>
	<br />

	*/ ?>

</div>