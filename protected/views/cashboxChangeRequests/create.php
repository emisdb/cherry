<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */

$this->breadcrumbs=array(
	'Cashbox Change Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CashboxChangeRequests', 'url'=>array('index')),
	array('label'=>'Manage CashboxChangeRequests', 'url'=>array('admin')),
);
?>

<h1>Create CashboxChangeRequests</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>