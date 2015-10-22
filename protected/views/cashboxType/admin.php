<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */

$this->breadcrumbs=array(
	//'Seg Cities'=>array('index'),
	'Cashbox types',
);

?>

<h1>Cashbox types</h1>
<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/cashboxType/create">New type</a></div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cashbox-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'value',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
