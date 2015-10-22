<?php
/* @var $this CashboxTypeController */
/* @var $model CashboxType */

$this->breadcrumbs=array(
	'Cashbox Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CashboxType', 'url'=>array('index')),
	array('label'=>'Create CashboxType', 'url'=>array('create')),
	array('label'=>'Update CashboxType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CashboxType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CashboxType', 'url'=>array('admin')),
);
?>

<h1>View CashboxType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
	),
)); ?>
