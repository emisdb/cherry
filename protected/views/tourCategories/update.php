<?php
/* @var $this TourCategoriesController */
/* @var $model TourCategories */

$this->breadcrumbs=array(
	'Tour Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id_tour_categories),
	'Update',
);

$this->menu=array(
	array('label'=>'List TourCategories', 'url'=>array('index')),
	array('label'=>'Create TourCategories', 'url'=>array('create')),
	array('label'=>'View TourCategories', 'url'=>array('view', 'id'=>$model->id_tour_categories)),
	array('label'=>'Manage TourCategories', 'url'=>array('admin')),
);
?>

<h1>Update TourCategories <?php echo $model->id_tour_categories; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>