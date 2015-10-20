<?php
/* @var $this CurrentSubscribersController */
/* @var $model CurrentSubscribers */

$this->breadcrumbs=array(
	'Current Subscribers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CurrentSubscribers', 'url'=>array('index')),
	array('label'=>'Create CurrentSubscribers', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#current-subscribers-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Current Subscribers</h1>

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
	'id'=>'current-subscribers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_contact',
		'tourist',
		'id_rabatt',
		'id_payoption',
		'price',
		/*
		'vat',
		'note',
		'id_guide',
		'id_tour',
		'id_report',
		'date_zakaz',
		'date_report',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
