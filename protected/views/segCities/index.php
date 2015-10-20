<?php
/* @var $this SegCitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Cities',
);

$this->menu=array(
	array('label'=>'Create SegCities', 'url'=>array('create')),
	array('label'=>'Manage SegCities', 'url'=>array('admin')),
);
?>

<h1>Seg Cities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
