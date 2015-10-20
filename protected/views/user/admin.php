<?php
$this->breadcrumbs=array(
	'Users',
);
?>
<?php 
if($role_control==1)$modelsearch = $model->search_root();
if($role_control==2)$modelsearch = $model->search_admin();
if($role_control==3)$modelsearch = $model->search_office();
?>

<h1>All users</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/create">New record</a></div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$modelsearch,//$model->search_root(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'role_ob',
            'value'=>'$data->role_ob->groupname',
            'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
		'username',
		'profile',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons' => array(
               'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/user/update/id/$data->id")',
                    'label'=>'Update',
               ),
               'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/user/delete/id/$data->id")',
                    'label'=>'Delete',
               ),
            ),
		),
	),
)); ?>
