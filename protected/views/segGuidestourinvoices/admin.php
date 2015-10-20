<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $model SegGuidestourinvoices */

$this->breadcrumbs=array(
	'Seg Guidestourinvoices'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoices', 'url'=>array('index')),
	array('label'=>'Create SegGuidestourinvoices', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seg-guidestourinvoices-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Seg Guidestourinvoices</h1>

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
	'id'=>'seg-guidestourinvoices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idseg_guidesTourInvoices',
		'creationDate',
		'cityid',
		'sched_tourid',
		'guideNr',
		'overAllIncome',
		/*
		'cashIncome',
		'InvoiceNumber',
		'TA_string',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
