<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages',
);

?>

<h1>Languages</h1>

<div class="create">
	<?php   echo CHtml::link('Neuen Sprache', array('lcreate')); ?>
</div>
      </section>

        <!-- Main content -->
        <section class="content">

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
            'buttons' => array(
               'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("lupdate", "id" => $data->id_languages)',
//                    'url' => 'Yii::app()->createUrl("/user/update/id/$data->id")',
                    'label'=>'Update',
               ),
               'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("ldelete", "id" => $data->id_languages)',
                    'label'=>'Delete',
               ),
            ),		),
	),
)); ?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
