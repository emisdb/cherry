<?php
/* @var $this SegStarttimesController */
/* @var $model SegStarttimes */

$this->breadcrumbs=array(
	'Start times',
);
?>

<h1>Start times</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segStartTimes/create">New times</a></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'seg-starttimes-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
	//	'idseg_starttimes',
		'timevalue',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
