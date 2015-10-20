<?php
/* @var $this PepletourController */
/* @var $model Pepletour */

$this->breadcrumbs=array(
	'Accounting of funds',
);
?>

<h1>All tours are enrolled tourists</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pepletour-grid',
	'dataProvider'=>$model->search_people($id_control),
	//'filter'=>$model,
	'columns'=>array(
	'idseg_scheduled_tours',
		
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
		/*'id',
		'number',
		'name',
		'tourist',
		'promotions',
		'method',
		
		'price',
		'vat',
		'note',
		'text',
		'sort',
		'visited',
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
            'buttons' => array(
               'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/peopletour/update/id/$data->idseg_scheduled_tours")',
                    'label'=>'Update',
               ),
               
            ),
		),
	),
)); ?>
