<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Manage Mains</h1>
      </section>

        <!-- Main content -->
        <section class="content">
<div class="create"><?php echo CHtml::link("Neuer Main",array("create_main")); ?></div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'main-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'text',
		'status',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
                'buttons' => array(
                'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("update_main", "id" => $data->id)',
                    'label'=>'Bearbeiten',
               ),
                'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("deleteCR", "id" => $data->id)',
               ),
             ),	
		),
	),
)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
