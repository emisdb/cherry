<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $model SegGuidestourinvoicescustomers */

$this->breadcrumbs=array(
	'Seg Guidestourinvoicescustomers'=>array('index'),
	$model->idseg_guidesTourInvoicesCustomers,
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoicescustomers', 'url'=>array('index')),
	array('label'=>'Create SegGuidestourinvoicescustomers', 'url'=>array('create')),
	array('label'=>'Update SegGuidestourinvoicescustomers', 'url'=>array('update', 'id'=>$model->idseg_guidesTourInvoicesCustomers)),
	array('label'=>'Delete SegGuidestourinvoicescustomers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_guidesTourInvoicesCustomers),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegGuidestourinvoicescustomers', 'url'=>array('admin')),
);
?>

<h1>View SegGuidestourinvoicescustomers #<?php echo $model->idseg_guidesTourInvoicesCustomers; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_guidesTourInvoicesCustomers',
		'tourInvoiceid',
		'customersName',
		'isTourist',
		'discounttype_id',
		'paymentoptionid',
		'price',
		'CustomerInvoiceNumber',
		'cityid',
		'KA_string',
		'isPaid',
		'origin_booking',
	),
)); ?>
