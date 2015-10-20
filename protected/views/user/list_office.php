<?php
$this->breadcrumbs=array(
	'Users',
);
?>

<h1>All users</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/create">New record</a></div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search_office(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
         array(
            'name'=>'role_ob',
            //'type'=>'raw',
            'value'=>'$data->role_ob->groupname',
           // 'value'=>'$data->name_section->name',
               'filter'=>CHtml::listData(Usergroups::model()->findAll(), 'idusergroups', 'groupname'),
            
            
            //'filter'=>array(0=>"Нет скидки",1=>"Есть скидка"),
           // 'filter'=>'',
           // 'htmlOptions' => array( 'class' => 't8'),
           // 'header'=>'',
        ),
		'username',
	//	'password',
	//	'email',
		'profile',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
		),
	),
)); ?>
