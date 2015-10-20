<?php
/* @var $this PepletourController */
/* @var $model Pepletour */

$this->breadcrumbs=array(
	'Pepletours'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Pepletour', 'url'=>array('index')),
	array('label'=>'Create Pepletour', 'url'=>array('create')),
	array('label'=>'Update Pepletour', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pepletour', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pepletour', 'url'=>array('admin')),
);
?>

<h1>View Pepletour #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'number',
		'name',
		'tourist',
		'promotions',
		'method',
		'price',
		'vat',
		'note',
		'text',
		'sort',
		'visited',
		'created',
	),
)); ?>
