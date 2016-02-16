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
                     <div style=" width:100px;">
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'publishDate',
 			'value'=>date("d.m.Y",strtotime($date)),
							'language'=>'de',
                             // additional javascript options for the date picker plugin
                            'options'=>array(
                               'showAnim'=>'fold',
                                'dateFormat' => 'dd.mm.yy',
                                 'yearRange'=>'2015:2050',
//                                 'minDate' => 0,//'01.06.2015',//0, 
                                 'defaultDate'=> time(),     
                                 //'maxDate' => '2099-12-31',  
                                 'onSelect'=> 'js: function(date) {if(date != "") { 
                                    window.location.href = "'.CHtml::encode($this->createUrl('guide/schedule'
                                    )).'/date/"+date ;
                                 } }',
                            ),
                            'htmlOptions'=>array(
                                 	'size' => '10',         // textField size
        							'maxlength' => '10', 
                            ),
                            'flat'=>false,
                        )); 
                    ?>
                    </div>
		</section>

        <!-- Main content -->
        <section class="content">


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sss-grid',
	'dataProvider'=>$model->search_s($id_control, $date),//$model->search_root(),
//	'filter'=>$model,
	'htmlOptions'=>array('class'=>'table-responsive'),
	
	'itemsCssClass'=>'table table-bordered',
	'rowCssClassExpression' => '$data->openTour || $data->date_now > '.$datetime.' ? "table_scheduled" : "table_scheduled_pdf"', 
	//'rowCssClassExpression' => '$date->openTour ? "table_scheduled" : "table_scheduled_pdf"', 
	'columns'=>array(
		array(
		
				'class'=>'CButtonColumn',
				'template'=>'{update}{pdf}{delete}',
				'buttons' => array(
				   'update' => array(
				   
						 //'imageUrl'=>'/images/system/proc.png',
						'url' => 'Yii::app()->createUrl("guide/current",array("id_sched"=>$data->idseg_scheduled_tours))',
						'label'=>'Invoice for guide',
						'visible'=>'$data->openTour!=1',
//						'visible'=>'$data->tourroute_id > 0 && $data->openTour!=1',
				   ),
				   'delete' => array(
						'url' => 'array("/guide/deleteST","id"=>$data->idseg_scheduled_tours,"date"=>"'.$date.'")',				   
						'visible'=>'is_null($data->current_subscribers)',
				   ),
				   'pdf' => array(
						'imageUrl'=>'/img/view.png',
						'url' => 'Yii::app()->createUrl("/filespdf/$data->additional_info2.pdf")',
					   'options'=>array("target"=>'_blank'),
						'label'=>'View PDF',
						'visible'=>'$data->openTour',
				   ),
				   
				),
						'headerHtmlOptions'=>array('class'=>'info'),
		),
        array(
            'name'=>'idseg_scheduled_tours',
 			'headerHtmlOptions'=>array('class'=>'info'),
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
       array(
            'name'=>'date_now',
            'value'=>'date("d.m.Y",$data->date_now)',
			'headerHtmlOptions'=>array('class'=>'info'),
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
        array(
            'name'=>'starttime',
                         'type'=>'raw',
           'value'=>"Yii::app()->dateFormatter->format('HH:mm',strtotime(\$data->starttime))",
   						'headerHtmlOptions'=>array('class'=>'info'),
         //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
    	array(
            'name'=>'tourroute_ob',
            'value'=>'$data->tourroute_ob["name"]',
    						'headerHtmlOptions'=>array('class'=>'info'),
        //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
  
         array(
            'name'=>'current_subscribers',
            'value'=>'$data->current_subscribers."/".$data->TNmax_sched',  
    						'headerHtmlOptions'=>array('class'=>'info'),
        //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
    // 'current_subscribers',
	//	'date_now',


	),
)); 
?>


     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
