<?php
/* @var $this SegTourroutesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Tourroutes',
);

$this->menu=array(
	array('label'=>'Create SegTourroutes', 'url'=>array('create')),
	array('label'=>'Manage SegTourroutes', 'url'=>array('admin')),
);
?>

<h1>Seg Tourroutes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
