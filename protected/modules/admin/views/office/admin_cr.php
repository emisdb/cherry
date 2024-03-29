<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Stornogrund</h1>
      </section>

        <!-- Main content -->
        <section class="content">

<div class="create"><?php echo CHtml::link("Neuer Eintrag",array("createcr")); ?></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cancellation-reason-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'htmlOptions'=>array('class'=>'table-responsive'),
	'itemsCssClass'=>'table table-bordered',
	'summaryText'=>'Zeigt {start} - {end} von {count} Einträgen',
	'columns'=>array(
		'id',
		'name',
		'value',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
                'buttons' => array(
                'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("updatecr", "id" => $data->id)',
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
