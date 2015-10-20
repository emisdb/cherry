<?php
$this->breadcrumbs=array(
	'Discount',
);

?>

<h1>Discount</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/bonus/create">New record</a></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bonus-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
	//	'id',
		'val',
		//'type',
		//array(
		//	'name'=>'type',
		//	'value'=>array('0'=>'euro','1'=>'%'),
		//),
		array(
		 'name' => 'type',    
           // 'type' => 'raw',    
            'value' => '$data->type',    
           //'filter' => array(0 => 'Все', 1 => 'Продажа', 2 => 'Аренда'),  
			),
		
		'name',
		'sort',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
