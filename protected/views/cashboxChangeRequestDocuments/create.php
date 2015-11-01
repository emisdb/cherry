<?php
/* @var $this CashboxChangeRequestDocumentsController */
/* @var $model CashboxChangeRequestDocuments */

$this->breadcrumbs=array(
	'Cashbox Change Request Documents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CashboxChangeRequestDocuments', 'url'=>array('index')),
	array('label'=>'Manage CashboxChangeRequestDocuments', 'url'=>array('admin')),
);
?>

<h1>Create CashboxChangeRequestDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>