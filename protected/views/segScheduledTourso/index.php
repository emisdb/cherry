<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Scheduled Tours',
);

$this->menu=array(
	array('label'=>'Create SegScheduledTours', 'url'=>array('create')),
	array('label'=>'Manage SegScheduledTours', 'url'=>array('admin')),
);
?>

<h1>Seg Scheduled Tours</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
