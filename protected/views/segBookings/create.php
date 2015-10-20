<?php
/* @var $this SegBookingsController */
/* @var $model SegBookings */

$this->breadcrumbs=array(
	'Seg Bookings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegBookings', 'url'=>array('index')),
	array('label'=>'Manage SegBookings', 'url'=>array('admin')),
);
?>

<h1>Create SegBookings</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>