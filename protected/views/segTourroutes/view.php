<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'Seg Tourroutes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SegTourroutes', 'url'=>array('index')),
	array('label'=>'Create SegTourroutes', 'url'=>array('create')),
	array('label'=>'Update SegTourroutes', 'url'=>array('update', 'id'=>$model->idseg_tourroutes)),
	array('label'=>'Delete SegTourroutes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_tourroutes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegTourroutes', 'url'=>array('admin')),
);
?>

<h1>View SegTourroutes #<?php echo $model->idseg_tourroutes; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_tourroutes',
		'name',
		'maintext',
		'shorttext',
		'TNmin',
		'TNmax',
		'inDevelopment',
		'route_bigpic',
		'route_pic',
		'pic_icon',
		'pdf_path',
		'base_price',
		'standard_duration',
		'cityid',
	),
)); ?>
