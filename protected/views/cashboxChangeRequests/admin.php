<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */

$this->breadcrumbs=array(
	'Cashbox Change Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CashboxChangeRequests', 'url'=>array('index')),
	array('label'=>'Create CashboxChangeRequests', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cashbox-change-requests-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cashbox Change Requests</h1>

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
	'id'=>'cashbox-change-requests-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idcashbox_change_requests',
		'id_users',
		'id_type',
		'delta_cash',
		'reason',
		'isApproved',
		/*
		'approvedBy',
		'request_date',
		'approval_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
