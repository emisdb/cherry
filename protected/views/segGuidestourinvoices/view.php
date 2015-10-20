<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $model SegGuidestourinvoices */

$this->breadcrumbs=array(
	'Seg Guidestourinvoices'=>array('index'),
	$model->idseg_guidesTourInvoices,
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoices', 'url'=>array('index')),
	array('label'=>'Create SegGuidestourinvoices', 'url'=>array('create')),
	array('label'=>'Update SegGuidestourinvoices', 'url'=>array('update', 'id'=>$model->idseg_guidesTourInvoices)),
	array('label'=>'Delete SegGuidestourinvoices', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_guidesTourInvoices),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegGuidestourinvoices', 'url'=>array('admin')),
);
?>

<h1>View SegGuidestourinvoices #<?php echo $model->idseg_guidesTourInvoices; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_guidesTourInvoices',
		'creationDate',
		'cityid',
		'sched_tourid',
		'guideNr',
		'overAllIncome',
		'cashIncome',
		'InvoiceNumber',
		'TA_string',
	),
)); ?>
