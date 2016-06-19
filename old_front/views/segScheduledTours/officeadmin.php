<?php
$this->breadcrumbs=array(
	'Scheduled Tours',
);

?>

<h1>Scheduled Tours</h1>




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
           /* 'buttons' => array(
               'eeeeee' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/user/update/id/$data->id")',
                    'label'=>'Update',
               ),
               'weeeeeeww' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/user/delete/id/$data->id")',
                    'label'=>'Delete',
               ),
            ),*/
		),
	),
)); ?>
