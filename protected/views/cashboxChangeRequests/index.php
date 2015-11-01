<?php
/* @var $this CashboxChangeRequestsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cashbox Change Requests',
);

$this->menu=array(
	array('label'=>'Create CashboxChangeRequests', 'url'=>array('create')),
	array('label'=>'Manage CashboxChangeRequests', 'url'=>array('admin')),
);
?>

<h1>Cashbox Change Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
