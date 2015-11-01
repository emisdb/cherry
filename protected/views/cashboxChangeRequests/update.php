<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */

$this->breadcrumbs=array(
	'Cashbox Change Requests'=>array('index'),
	$model->idcashbox_change_requests=>array('view','id'=>$model->idcashbox_change_requests),
	'Update',
);

$this->menu=array(
	array('label'=>'List CashboxChangeRequests', 'url'=>array('index')),
	array('label'=>'Create CashboxChangeRequests', 'url'=>array('create')),
	array('label'=>'View CashboxChangeRequests', 'url'=>array('view', 'id'=>$model->idcashbox_change_requests)),
	array('label'=>'Manage CashboxChangeRequests', 'url'=>array('admin')),
);
?>

<h1>Update CashboxChangeRequests <?php echo $model->idcashbox_change_requests; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>