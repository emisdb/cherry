<?php
/* @var $this TourCategoriesController */
/* @var $model TourCategories */

$this->breadcrumbs=array(
	'Tour Categories'=>array('index'),
	'New record',
);


?>

<h1>Create TourCategories</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>