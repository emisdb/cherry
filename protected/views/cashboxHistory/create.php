<?php
/* @var $this CashboxHistoryController */
/* @var $model CashboxHistory */

$this->breadcrumbs=array(
	'Cashbox Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CashboxHistory', 'url'=>array('index')),
	array('label'=>'Manage CashboxHistory', 'url'=>array('admin')),
);
?>

<h1>Create CashboxHistory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>