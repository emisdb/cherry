<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */

$this->breadcrumbs=array(
	'Seg Guidesdatas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SegGuidesdata', 'url'=>array('index')),
	array('label'=>'Create SegGuidesdata', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seg-guidesdata-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Seg Guidesdatas</h1>

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
	'id'=>'seg-guidesdata-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idseg_guidesdata',
		'base_provision',
		'cash_box',
		'guide_shorttext',
		'guide_maintext',
		'lnk_to_picture',
		/*
		'guest_variable',
		'paysUSt',
		'guestsMinforVariable',
		'taxnumber',
		'taxoffice',
		'invoiceCount2013',
		'invoiceCount2014',
		'inVoiceCount2015',
		'voucher_cashbox',
		'voucher_provision',
		'immediate_voucher_payment',
		'guides_cashbox_account_DTV',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
