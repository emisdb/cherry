<?php
/* @var $this CashboxTypeController */
/* @var $model CashboxType */

$this->breadcrumbs=array(
	'Cashbox Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CashboxType', 'url'=>array('index')),
	array('label'=>'Create CashboxType', 'url'=>array('create')),
	array('label'=>'View CashboxType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CashboxType', 'url'=>array('admin')),
);
?>

<h1>Update CashboxType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>