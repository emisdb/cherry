<?php
/* @var $this SegBookingsController */
/* @var $model SegBookings */

$this->breadcrumbs=array(
	'Seg Bookings'=>array('index'),
	$model->idseg_bookings,
);

$this->menu=array(
	array('label'=>'List SegBookings', 'url'=>array('index')),
	array('label'=>'Create SegBookings', 'url'=>array('create')),
	array('label'=>'Update SegBookings', 'url'=>array('update', 'id'=>$model->idseg_bookings)),
	array('label'=>'Delete SegBookings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_bookings),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegBookings', 'url'=>array('admin')),
);
?>

<h1>View SegBookings #<?php echo $model->idseg_bookings; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_bookings',
		'customer_id',
		'customer_annotation',
		'pay_option_id',
		'isPrivate',
		'groupsize',
		'status',
		'sched_tourid',
		'discounttype_id',
		'plusUSt',
		'isPaid',
	),
)); ?>
