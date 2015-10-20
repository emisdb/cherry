<?php
/* @var $this MainoptionsController */
/* @var $model Mainoptions */

$this->breadcrumbs=array(
	'Main options',
);
?>

<h1>Main options</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/mainoptions/create">New option</a></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mainoptions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'value',
		'name',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
           
		),
	),
)); ?>
