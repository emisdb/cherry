<?php
/* @var $this CashboxChangeRequestDocumentsController */
/* @var $data CashboxChangeRequestDocuments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idcashbox_change_request_documents')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idcashbox_change_request_documents), array('view', 'id'=>$data->idcashbox_change_request_documents)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cashbox_change_requestid')); ?>:</b>
	<?php echo CHtml::encode($data->cashbox_change_requestid); ?>
	<br />


</div>