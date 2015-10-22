<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
$this->breadcrumbs=array(
	'Scheduled Tours',
);

?> 
<style>
	.table_scheduled_pdf,.grid-view table.items tbody tr.table_scheduled_pdf:hover{ background:red; }
	.table_scheduled{ background:#eeeeee; }
</style>



<?php 
$datetime = time();
?>
<h1>Scheduled Tours</h1>
      </section>

        <!-- Main content -->
        <section class="content">


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sss-grid',
	'dataProvider'=>$model->search_s($id_control),//$model->search_root(),
//	'filter'=>$model,
	'rowCssClassExpression' => '$data->openTour || $data->date_now > '.$datetime.' ? "table_scheduled" : "table_scheduled_pdf"', 
	//'rowCssClassExpression' => '$date->openTour ? "table_scheduled" : "table_scheduled_pdf"', 
	'columns'=>array(
    	'idseg_scheduled_tours',
        array(
            'name'=>'date_now',
            'value'=>'date("d.m.Y",$data->date_now)',
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
		'starttime',
  
    	array(
            'name'=>'tourroute_ob',
            'value'=>'$data->tourroute_ob["name"]',
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
  
         array(
            'name'=>'current_subscribers',
            'value'=>'$data->current_subscribers."/".$data->TNmax_sched',  
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
    // 'current_subscribers',
	//	'date_now',

		array(
		
				'class'=>'CButtonColumn',
				'template'=>'{update}{pdf}{delete}',
				'buttons' => array(
				   'update' => array(
				   
						 //'imageUrl'=>'/images/system/proc.png',
						'url' => 'Yii::app()->createUrl("/guide/current/id_sched/$data->idseg_scheduled_tours/date/$data->date/time/$data->starttime")',
						'label'=>'Invoice for guide',
						//'visible'=>'$data->tourroute_id > 0 && $data->openTour!=1',
						'visible'=>'$data->tourroute_id > 0 && $data->openTour!=1',
				   ),
				   'delete' => array(
				   
						'visible'=>'is_null($data->current_subscribers)',
				   ),
				   'pdf' => array(
						'imageUrl'=>'/img/view.png',
						'url' => 'Yii::app()->createUrl("/guide/current/id_sched/$data->idseg_scheduled_tours/date/$data->date/time/$data->starttime")',
						'label'=>'View PDF',
						'visible'=>'$data->openTour',
				   ),
				   
				),
		),
	),
)); ?>

	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
