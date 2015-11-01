<?php
/* @var $this CashboxChangeRequestDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cashbox Change Request Documents',
);

$this->menu=array(
	array('label'=>'Create CashboxChangeRequestDocuments', 'url'=>array('create')),
	array('label'=>'Manage CashboxChangeRequestDocuments', 'url'=>array('admin')),
);
?>

<h1>Cashbox Change Request Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
