<?php
/* @var $this SegGuidesCitiesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Guides Cities',
);

$this->menu=array(
	array('label'=>'Create SegGuidesCities', 'url'=>array('create')),
	array('label'=>'Manage SegGuidesCities', 'url'=>array('admin')),
);
?>

<h1>Seg Guides Cities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
