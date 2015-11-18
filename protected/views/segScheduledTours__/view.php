<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Seg Scheduled Tours'=>array('index'),
	$model->idseg_scheduled_tours,
);

$this->menu=array(
	array('label'=>'List SegScheduledTours', 'url'=>array('index')),
	array('label'=>'Create SegScheduledTours', 'url'=>array('create')),
	array('label'=>'Update SegScheduledTours', 'url'=>array('update', 'id'=>$model->idseg_scheduled_tours)),
	array('label'=>'Delete SegScheduledTours', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_scheduled_tours),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegScheduledTours', 'url'=>array('admin')),
);
?>

<h1>View SegScheduledTours #<?php echo $model->idseg_scheduled_tours; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_scheduled_tours',
		'tourroute_id',
		'openTour',
		'TNmax_sched',
		'duration',
		'starttime',
		'date',
		'date_now',
		'current_subscribers',
		'language_id',
		'guide1_id',
		'guide2_id',
		'guide3_id',
		'guide4_id',
		'original_starttime',
		'additional_info',
		'visibility',
		'city_id',
		'isInvoiced_guide1',
		'isInvoiced_guide2',
		'isInvoiced_guide3',
		'isInvoiced_guide4',
		'additional_info2',
		'isCanceled',
		'cancellationReason',
		'canceledBy',
		'cancellationAnnotation',
		'GN_string',
	),
)); ?>
