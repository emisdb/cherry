<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			
			<?php
$this->breadcrumbs=array(
	'Users',
);
?>
<?php $modelsearch = $model->search_office();	?>

<h1>All users</h1>

<div class="create">
	<?php   echo CHtml::link('Neuen User', array('ucreate')); ?>
</div>

       </section>

        <!-- Main content -->
        <section class="content">



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
                    'url' => 'array("uupdate", "id" => $data->id)',
//                    'url' => 'Yii::app()->createUrl("/user/update/id/$data->id")',
                    'label'=>'Update',
               ),
               'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("delete", "id" => $data->id, "type"=>1)',
                    'label'=>'Delete',
               ),
            ),
		),
	),
)); ?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->