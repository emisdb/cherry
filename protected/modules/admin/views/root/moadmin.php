<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
$this->breadcrumbs=array(
	'Main options',
);
 $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'homeLink'=>false,
        'tagName'=>'ul',
        'separator'=>'',
        'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
        'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
        'htmlOptions'=>array ('class'=>'breadcrumb')
    ));
?>


<h1>Main options</h1>

<div class="create">
	<?php   echo CHtml::link('New option', array('mocreate')); ?>
</div>
      </section>

        <!-- Main content -->
        <section class="content">

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
            'buttons' => array(
               'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("moupdate", "id" => $data->id)',
                    'label'=>'Update',
               ),
               'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("delete", "id" => $data->id, "type"=>7)',
                    'label'=>'Delete',
               ),
            ),		),
	),
)); ?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
