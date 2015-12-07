<style>
	.table_scheduled_pdf,.grid-view table.items tbody tr.table_scheduled_pdf:hover{ background:red;  color:#fff; font-weight: bold; }
	.table_scheduled{ background:#eeeeee; }
	.cell_green{ background-color:#46a546; color:#000; }
	.cell_yellow{ background:#FFE495; color:#000; }
</style>
<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>All users</h1>

<div class="create">
	<?php   echo CHtml::link('New user', array('userCreate')); ?>
 </div>
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
        'rowCssClassExpression' => '$data->payNA>0 ? "table_scheduled_pdf" : "table_scheduled"', 
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
					'cssClassExpression' => '$data->paySum<300 ? "cell_green" : ($data->paySum>1500 ? "cell_yellow" : "")',
								  ),
				array(
                'class'=>'CButtonColumn',
                'template'=>'{update}{pwd}{cash}{delete}',
                'htmlOptions' => array('style'=>'width:100px;'),
                'buttons' => array(
                'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("userUpdate", "id" => $data->id)',
                    'label'=>'Update',
               ),
                'pwd' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("ucontact","id"=>$data->id_contact,"id_user"=>$data->id)',
                    'label'=>'<i class="fa fa-user" style="padding:0 3px;"></i>',
               ),
                'cash' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("cashReport","id"=>$data->id)',
                    'label'=>'<i class="fa fa-credit-card" style="padding:0 3px;"></i>',
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
