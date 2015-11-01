<?php
/* @var $this CashboxChangeRequestDocumentsController */
/* @var $model CashboxChangeRequestDocuments */

$this->breadcrumbs=array(
	'Cashbox Change Request Documents'=>array('index'),
	$model->idcashbox_change_request_documents=>array('view','id'=>$model->idcashbox_change_request_documents),
	'Update',
);

$this->menu=array(
	array('label'=>'List CashboxChangeRequestDocuments', 'url'=>array('index')),
	array('label'=>'Create CashboxChangeRequestDocuments', 'url'=>array('create')),
	array('label'=>'View CashboxChangeRequestDocuments', 'url'=>array('view', 'id'=>$model->idcashbox_change_request_documents)),
	array('label'=>'Manage CashboxChangeRequestDocuments', 'url'=>array('admin')),
);
?>

<h1>Update CashboxChangeRequestDocuments <?php echo $model->idcashbox_change_request_documents; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>