<?php
/* @var $this SegGuidesdataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Guidesdatas',
);

$this->menu=array(
	array('label'=>'Create SegGuidesdata', 'url'=>array('create')),
	array('label'=>'Manage SegGuidesdata', 'url'=>array('admin')),
);
?>

<h1>Seg Guidesdatas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
