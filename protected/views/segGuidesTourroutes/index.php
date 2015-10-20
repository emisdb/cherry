<?php
/* @var $this SegGuidesTourroutesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Guides Tourroutes',
);

$this->menu=array(
	array('label'=>'Create SegGuidesTourroutes', 'url'=>array('create')),
	array('label'=>'Manage SegGuidesTourroutes', 'url'=>array('admin')),
);
?>

<h1>Seg Guides Tourroutes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
