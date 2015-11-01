<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */

$this->breadcrumbs=array(
	'Cashbox Change Requests'=>array('index'),
	$model->idcashbox_change_requests,
);

$this->menu=array(
	array('label'=>'List CashboxChangeRequests', 'url'=>array('index')),
	array('label'=>'Create CashboxChangeRequests', 'url'=>array('create')),
	array('label'=>'Update CashboxChangeRequests', 'url'=>array('update', 'id'=>$model->idcashbox_change_requests)),
	array('label'=>'Delete CashboxChangeRequests', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcashbox_change_requests),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CashboxChangeRequests', 'url'=>array('admin')),
);
?>

<h1>View CashboxChangeRequests #<?php echo $model->idcashbox_change_requests; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcashbox_change_requests',
		'id_users',
		'id_type',
		'delta_cash',
		'reason',
		'isApproved',
		'approvedBy',
		'request_date',
		'approval_date',
	),
)); ?>
