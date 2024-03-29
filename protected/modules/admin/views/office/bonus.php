<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Rabatt</h1>
      </section>

        <!-- Main content -->
        <section class="content">

<div class="create"><?php echo CHtml::link("Neuer Eintrag",array("create")); ?></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bonus-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions'=>array('class'=>'table-responsive'),
	'itemsCssClass'=>'table table-bordered',
//	'filter'=>$model,
	'summaryText'=>'Zeigt {start} - {end} von {count} Einträgen',
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
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
