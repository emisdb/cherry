<?php
/* @var $this TourCategoriesController */
/* @var $model TourCategories */

$this->breadcrumbs=array(
	'Tour Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TourCategories', 'url'=>array('index')),
	array('label'=>'Create TourCategories', 'url'=>array('create')),
	array('label'=>'Update TourCategories', 'url'=>array('update', 'id'=>$model->id_tour_categories)),
	array('label'=>'Delete TourCategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_tour_categories),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TourCategories', 'url'=>array('admin')),
);
?>

<h1>View TourCategories #<?php echo $model->id_tour_categories; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_tour_categories',
		'name',
	),
)); ?>
