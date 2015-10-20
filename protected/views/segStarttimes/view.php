<?php
/* @var $this SegStarttimesController */
/* @var $model SegStarttimes */

$this->breadcrumbs=array(
	'Seg Starttimes'=>array('index'),
	$model->idseg_starttimes,
);

$this->menu=array(
	array('label'=>'List SegStarttimes', 'url'=>array('index')),
	array('label'=>'Create SegStarttimes', 'url'=>array('create')),
	array('label'=>'Update SegStarttimes', 'url'=>array('update', 'id'=>$model->idseg_starttimes)),
	array('label'=>'Delete SegStarttimes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_starttimes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegStarttimes', 'url'=>array('admin')),
);
?>

<h1>View SegStarttimes #<?php echo $model->idseg_starttimes; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_starttimes',
		'timevalue',
	),
)); ?>
