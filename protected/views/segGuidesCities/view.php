<?php
/* @var $this SegGuidesCitiesController */
/* @var $model SegGuidesCities */

$this->breadcrumbs=array(
	'Seg Guides Cities'=>array('index'),
	$model->idseg_guides_cities,
);

$this->menu=array(
	array('label'=>'List SegGuidesCities', 'url'=>array('index')),
	array('label'=>'Create SegGuidesCities', 'url'=>array('create')),
	array('label'=>'Update SegGuidesCities', 'url'=>array('update', 'id'=>$model->idseg_guides_cities)),
	array('label'=>'Delete SegGuidesCities', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_guides_cities),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegGuidesCities', 'url'=>array('admin')),
);
?>

<h1>View SegGuidesCities #<?php echo $model->idseg_guides_cities; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_guides_cities',
		'users_id',
		'cities_id',
	),
)); ?>
