<?php
/* @var $this CurrentSubscribersController */
/* @var $model CurrentSubscribers */

$this->breadcrumbs=array(
	'Current Subscribers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CurrentSubscribers', 'url'=>array('index')),
	array('label'=>'Create CurrentSubscribers', 'url'=>array('create')),
	array('label'=>'Update CurrentSubscribers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CurrentSubscribers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CurrentSubscribers', 'url'=>array('admin')),
);
?>

<h1>View CurrentSubscribers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_contact',
		'tourist',
		'id_rabatt',
		'id_payoption',
		'price',
		'vat',
		'note',
		'id_guide',
		'id_tour',
		'id_report',
		'date_zakaz',
		'date_report',
	),
)); ?>
