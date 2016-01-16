<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Seg Scheduled Tours'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SegScheduledTours', 'url'=>array('index')),
	array('label'=>'Create SegScheduledTours', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seg-scheduled-tours-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Seg Scheduled Tours</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seg-scheduled-tours-grid',
	'dataProvider'=>$model->search_f(1),
	'filter'=>$model,
	'columns'=>array(
		'idseg_scheduled_tours',
		'tourroute_id',
		'openTour',
		'TNmax_sched',
		'duration',
		'starttime',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
