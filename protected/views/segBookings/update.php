<?php
/* @var $this SegBookingsController */
/* @var $model SegBookings */

$this->breadcrumbs=array(
	'Seg Bookings'=>array('index'),
	$model->idseg_bookings=>array('view','id'=>$model->idseg_bookings),
	'Update',
);

$this->menu=array(
	array('label'=>'List SegBookings', 'url'=>array('index')),
	array('label'=>'Create SegBookings', 'url'=>array('create')),
	array('label'=>'View SegBookings', 'url'=>array('view', 'id'=>$model->idseg_bookings)),
	array('label'=>'Manage SegBookings', 'url'=>array('admin')),
);
?>

<h1>Update SegBookings <?php echo $model->idseg_bookings; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>