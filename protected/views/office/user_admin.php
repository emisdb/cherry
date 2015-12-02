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
      'ajaxUpdate'=>false,
//	'ajaxUrl'=> Yii::app()->request->getUrl(),
		'dataProvider'=>$modelsearch,//$model->search_root(),
	'filter'=>$model,
	'columns'=>array(
/*
 *         array(
            'name'=>'role_ob',
            'value'=>'$data->role_ob->groupname',
            'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
            ),
*/          'guidename',
		        array(
            'name'=>'status',
			'value'=>array($model,'statuslabel'),
            ),
		
            'cityname',
                              array(
					'name'=>'paySum',
					'type'=>'raw',
//					'header'=>'Опл.',
					'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->paySum, '')",
					'filter'=>true, // Set the filter to false when date range searching
					'htmlOptions'=>array('style' => 'text-align: right;'),
				),
				array(
                'class'=>'CButtonColumn',
                'template'=>'{update}{delete}',
                'buttons' => array(
                'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("userUpdate", "id" => $data->id)',
                    'label'=>'Update',
               ),
                'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("userDelete", "id" => $data->id)',
               ),
             ),
            ),
	),
)); ?>

     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
