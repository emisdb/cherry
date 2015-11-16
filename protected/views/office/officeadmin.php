 <?php $this->renderPartial('_top', array('info'=>$info)); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

<h1>Scheduled Tours</h1>	
       </section>

        <!-- Main content -->
        <section class="content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'officeadmin-grid',
	'dataProvider'=>$model->search(),//$model->search_root(),
	'filter'=>$model,
	'columns'=>array(
    	'idseg_scheduled_tours',
		array(
            'name'=>'user_ob',	
            'value'=>'$data->user_ob["username"]',
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
        array(
            'name'=>'date_now',	
            'value'=>'date("d.m.Y",$data->date_now)',
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
		'starttime',
  
    	array(
            'name'=>'language_ob',
            'value'=>'$data->language_ob["englishname"]',
            //'filter'=>CHtml::listData($languages_guide, 'id_languages', 'englishname'),
        ),
		  
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
            'template'=>'{update}',
            'buttons' => array(
				   'update' => array(
				   
						 //'imageUrl'=>'/images/system/proc.png',
						'url' => 'Yii::app()->createUrl("office/current",array("id_sched"=>$data->idseg_scheduled_tours))',
						'label'=>'Invoice for guide',
//						'visible'=>'$data->openTour!=1',
//						'visible'=>'$data->tourroute_id > 0 && $data->openTour!=1',
				   ),
            ),
		),
	),
)); ?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->