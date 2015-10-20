<?php
/* @var $this CashboxHistoryController */
/* @var $model CashboxHistory */

$this->breadcrumbs=array(
	'Cashbox Histories'=>array('index'),
	$model->idcashbox_history=>array('view','id'=>$model->idcashbox_history),
	'Update',
);

$this->menu=array(
	array('label'=>'List CashboxHistory', 'url'=>array('index')),
	array('label'=>'Create CashboxHistory', 'url'=>array('create')),
	array('label'=>'View CashboxHistory', 'url'=>array('view', 'id'=>$model->idcashbox_history)),
	array('label'=>'Manage CashboxHistory', 'url'=>array('admin')),
);
?>

<h1>Update CashboxHistory <?php echo $model->idcashbox_history; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>