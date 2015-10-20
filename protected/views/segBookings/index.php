<?php
/* @var $this SegBookingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Bookings',
);

$this->menu=array(
	array('label'=>'Create SegBookings', 'url'=>array('create')),
	array('label'=>'Manage SegBookings', 'url'=>array('admin')),
);
?>

<h1>Seg Bookings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
