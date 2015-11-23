<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>All users</h1>

<div class="create"><a href="<?php echo Yii::app()->request->baseUrl; ?>/user/create">New record</a></div>
<hr />	
       </section>
		
        <!-- Main content -->
        <section class="content">

<?php 
    $modelsearch = $model->search_office();

    $this->widget('zii.widgets.grid.CGridView', array(
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
                    'url' => 'Yii::app()->createUrl("office/userUpdate", array("id" => $data->id))',
                    'label'=>'Update',
               ),
             ),
            ),
	),
)); ?>

     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
