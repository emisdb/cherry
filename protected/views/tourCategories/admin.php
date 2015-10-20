<?php
/* @var $this TourCategoriesController */
/* @var $model TourCategories */

$this->breadcrumbs=array(
	'Tour categories',

);

?>

<h1>Manage Tour Categories</h1>

<!--
<div class="create"><a href="<php echo Yii::app()->request->baseUrl; ?>/tourcategories/create">New record</a></div>
-->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tour-categories-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id_tour_categories',
		'name',
	//	array(
	//		'class'=>'CButtonColumn',
	//	),
	),
)); ?>
