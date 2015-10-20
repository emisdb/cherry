<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'Tourroutes',
);

?>

<h1>Tourroutes</h1>

<div class="create"><a href="<?php echo Yii::app()->createUrl('/segTourroutes/create'); ?>">New tour</a></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seg-tourroutes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'idseg_tourroutes',
        array(
            'name'=>'city',
            'value'=>'$data->city->seg_cityname',
            'filter'=>CHtml::listData(SegCities::model()->findAll(), 'idseg_cities', 'seg_cityname'),
        ),
        array(
            'name'=>'tour_categories',
            'value'=>'$data->tour_categories->name',
            'filter'=>CHtml::listData(TourCategories::model()->findAll(), 'id_tour_categories', 'name'),
        ),
		'name',
        'base_price',
		'standard_duration',
	//	'maintext',
	//	'shorttext',
	//	'TNmin',
	//	'TNmax',
		/*
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
            'template'=>'{update}{delete}',
		),
	),
)); ?>
