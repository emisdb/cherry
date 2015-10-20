<?php
/* @var $this SegStarttimesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Starttimes',
);

$this->menu=array(
	array('label'=>'Create SegStarttimes', 'url'=>array('create')),
	array('label'=>'Manage SegStarttimes', 'url'=>array('admin')),
);
?>

<h1>Seg Starttimes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
