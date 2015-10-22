<?php
/* @var $this CashboxTypeController */
/* @var $model CashboxType */

$this->breadcrumbs=array(
	'Cashbox Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CashboxType', 'url'=>array('index')),
	array('label'=>'Manage CashboxType', 'url'=>array('admin')),
);
?>

<h1>Create CashboxType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>