<?php
$this->breadcrumbs=array(
	'Scheduled Tours',
);

?> 
<style>
	.table_scheduled_pdf,.grid-view table.items tbody tr.table_scheduled_pdf:hover{ background:red; }
	.table_scheduled{ background:#eeeeee; }
</style>



<? 
$datetime = time();?>
<h1>Scheduled Tours</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sss-grid',
	'dataProvider'=>$model->search_f(),//$model->search_root(),
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
				'template'=>'{update}{pdf}',
				'buttons' => array(
				   'update' => array(
				   
						 //'imageUrl'=>'/images/system/proc.png',
						'url' => 'Yii::app()->createUrl("/segGuidestourinvoicescustomers/current/id_sched/$data->idseg_scheduled_tours/date/$data->date/time/$data->starttime")',
						'label'=>'Invoice for guide',
						//'visible'=>'$data->tourroute_id > 0 && $data->openTour!=1',
						'visible'=>'$data->tourroute_id > 0 && $data->openTour!=1',
				   ),
				   'pdf' => array(
						'imageUrl'=>'/img/view.png',
						'url' => 'Yii::app()->createUrl("/segGuidestourinvoicescustomers/current/id_sched/$data->idseg_scheduled_tours/date/$data->date/time/$data->starttime")',
						'label'=>'View PDF',
						'visible'=>'$data->openTour',
				   ),
				   
				),
		),
	),
)); ?>