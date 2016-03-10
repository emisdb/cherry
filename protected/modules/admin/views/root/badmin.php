<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
$this->breadcrumbs=array(
	'Discount',
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

<h1>Discount</h1>

<div class="create">
	<?php   echo CHtml::link('New record', array('bcreate')); ?>
</div>
      </section>

        <!-- Main content -->
        <section class="content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bonus-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
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
            'buttons' => array(
               'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("bupdate", "id" => $data->id)',
//                    'url' => 'Yii::app()->createUrl("/user/update/id/$data->id")',
                    'label'=>'Update',
               ),
               'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("delete", "id" => $data->id, "type"=>6)',
                    'label'=>'Delete',
               ),
            ),		),
	),
)); ?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
