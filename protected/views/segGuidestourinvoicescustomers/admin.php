<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $model SegGuidestourinvoicescustomers */

$this->breadcrumbs=array(
	'Seg Guidestourinvoicescustomers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoicescustomers', 'url'=>array('index')),
	array('label'=>'Create SegGuidestourinvoicescustomers', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seg-guidestourinvoicescustomers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Seg Guidestourinvoicescustomers</h1>

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
	'id'=>'seg-guidestourinvoicescustomers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idseg_guidesTourInvoicesCustomers',
		'tourInvoiceid',
		'customersName',
		'isTourist',
		'discounttype_id',
		'paymentoptionid',
		/*
		'price',
		'CustomerInvoiceNumber',
		'cityid',
		'KA_string',
		'isPaid',
		'origin_booking',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
