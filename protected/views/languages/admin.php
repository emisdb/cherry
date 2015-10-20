<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages',
);

?>

<h1>Languages</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/languages/create">New record</a></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'languages-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
	'columns'=>array(
	//	'id_languages',
		'shortname',
		//'germanname',
		'englishname',
         array(
            'name' => 'flagpic',
            'type' => 'image',
            'value' => 'Yii::app()->request->baseUrl."/img/lan/".$data->flagpic',
            'filter' => false,
        ),

	//	'flagpic',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
