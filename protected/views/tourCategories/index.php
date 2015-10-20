<?php
/* @var $this TourCategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tour Categories',
);

$this->menu=array(
	array('label'=>'Create TourCategories', 'url'=>array('create')),
	array('label'=>'Manage TourCategories', 'url'=>array('admin')),
);
?>

<h1>Tour Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
