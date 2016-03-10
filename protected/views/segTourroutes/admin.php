<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'Seg Tourroutes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SegTourroutes', 'url'=>array('index')),
	array('label'=>'Create SegTourroutes', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seg-tourroutes-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Seg Tourroutes</h1>

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
	'id'=>'seg-tourroutes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'idseg_tourroutes',
		'id_tour_categories',
		'name',
		'maintext',
		'maintext_en',
		'shorttext',
		/*
		'shorttext_en',
		'gmaps_lnk',
		'meetingpoint_description',
		'meetingpoint_description_en',
		'TNmin',
		'TNmax',
		'inDevelopment',
		'route_bigpic',
		'route_pic',
		'pic_icon',
		'pdf_path',
		'base_price',
		'standard_duration',
		'cityid',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
