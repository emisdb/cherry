<?php
$this->breadcrumbs=array(
	'Users',
);
?>

<h1>All users</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/create_root">New record</a></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search_root(),
	'filter'=>$model,
	'columns'=>array(
         array(
            'name'=>'role_ob',
            'value'=>'$data->role_ob->groupname',
            'filter'=>CHtml::listData(Usergroups::model()->findAll(), 'idusergroups', 'groupname'),
        ),
		'username',
		'profile',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons' => array(
               'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/user/update_root/id/$data->id")',
                    'label'=>'Update',
               ),
               'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/user/delete_root/id/$data->id")',
                    'label'=>'Delete',
               ),
            ),
		),
	),
)); ?>
