<?php
/* @var $this CashboxChangeRequestDocumentsController */
/* @var $model CashboxChangeRequestDocuments */

$this->breadcrumbs=array(
	'Cashbox Change Request Documents'=>array('index'),
	$model->idcashbox_change_request_documents,
);

$this->menu=array(
	array('label'=>'List CashboxChangeRequestDocuments', 'url'=>array('index')),
	array('label'=>'Create CashboxChangeRequestDocuments', 'url'=>array('create')),
	array('label'=>'Update CashboxChangeRequestDocuments', 'url'=>array('update', 'id'=>$model->idcashbox_change_request_documents)),
	array('label'=>'Delete CashboxChangeRequestDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcashbox_change_request_documents),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CashboxChangeRequestDocuments', 'url'=>array('admin')),
);
?>

<h1>View CashboxChangeRequestDocuments #<?php echo $model->idcashbox_change_request_documents; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcashbox_change_request_documents',
		'link',
		'cashbox_change_requestid',
	),
)); ?>
