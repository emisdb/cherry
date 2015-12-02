<style>
	.table_scheduled_pdf,.grid-view table.items tbody tr.table_scheduled_pdf:hover{ background:red;  color:#fff; font-weight: bold; }
	.table_scheduled{ background:#eeeeee; }
</style>
 <?php $this->renderPartial('_top', array('info'=>$info)); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">

<h1>Scheduled Tours</h1>	
       </section>
		<?php
		$this->beginWidget('CActiveForm', array(
			'id'=>'current-subscriber-form',
			'enableAjaxValidation'=>false,
		)); 
		?>
		<input type="hidden" name="newrecord" id="newrecord" value="0">
		<div class="create" style="text-align: left;">New record for 
		<?php
		echo CHtml::dropDownList('new_city',0, CHtml::listData (SegCities::model()->findAll(), 'idseg_cities', 'seg_cityname'));
		echo CHtml::link("create","javascript:void(0);",array('onclick'=>'newtourist();'));
		$this->endWidget();
		?>
		</div>

        <!-- Main content -->
        <section class="content">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'date-form',
    'htmlOptions'=>array(
	'name'=>'date-form',
    ),
    'enableAjaxValidation'=>true,
)); ?>
		<div class="row">
			<div class="col-md-1">
				<b>From :</b>				
			</div>
			<div class="col-md-2">
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'SegScheduledTours[from_date]',
				  'attribute'=>'from_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//   'name'=>'from_date',  // name of post parameter
  //   'value'=>Yii::app()->request->cookies['from_date']->value,  
	// value comes from cookie after submittion
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>				
			</div>
			<div class="col-md-1">
				<b>to :</b>				
			</div>
			<div class="col-md-2">

<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'SegScheduledTours[to_date]',
				  'attribute'=>'to_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//    'name'=>'to_date',
 //    'value'=>Yii::app()->request->cookies['to_date']->value,
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
 
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>				
			</div>
			<div class="col-md-6">
				<?php echo CHtml::submitButton('Filter'); // submit button ?> 
			</div>
		</div>
 <?php $this->endWidget(); ?>	
		<div class="row">
			<div class="col-md-12">

<?php 
    $datetime = time();
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'officeadmin-grid',
      'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),//$model->search_root(),
        'rowCssClassExpression' => '$data->openTour || $data->date_now > '.$datetime.' ? "table_scheduled" : "table_scheduled_pdf"', 
	    'enablePagination'=>false,
	'filter'=>$model,
   'htmlOptions'=>array(
	'style'=>'padding-top: 0px;',
    ),
	'columns'=>array(
    	'idseg_scheduled_tours',
		'guidename',
/*			'date_now',
	array(
            'name'=>'user_ob',	
            'value'=>'$data->user_ob["username"]',
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
 */       array(
            'name'=>'date_now',	
            'value'=>'date("d.m.Y",$data->date_now)',
            'filter'=>false,
             //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
		'starttime',
		'langname',
		'trname',
            'isCanceled',
/*  
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
  */
         array(
            'name'=>'current_subscribers',
            'value'=>'$data->current_subscribers."/".$data->TNmax_sched',  
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),

	// 'current_subscribers',
	//	'date_now',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{edit}{update}{delete}{pdf}',
			'htmlOptions'=>array("width"=>"80px"),
            'buttons' => array(
				   'update' => array(
				   
						 //'imageUrl'=>'/images/system/proc.png',
						'url' => 'Yii::app()->createUrl("office/current",array("id_sched"=>$data->idseg_scheduled_tours))',
						'label'=>'Invoice for guide',
//						'visible'=>'$data->openTour!=1',
//						'visible'=>'$data->tourroute_id > 0 && $data->openTour!=1',
				   ),
 				   'delete' => array(
						'url' => 'array("deleteST","id"=>"$data->idseg_scheduled_tours")',				   
						'visible'=>'is_null($data->current_subscribers)',
				   ),
				   'edit' => array(
						'imageUrl'=>'/img/view.png',
						'url' => "array('sched','id'=>\$data->idseg_scheduled_tours)",
						'label'=>'Edit tour',
				   ),
				   'pdf' => array(
						'imageUrl'=>'/img/pdf.png',
						'url' => 'Yii::app()->createUrl("/filespdf/$data->additional_info2.pdf")',
					   'options'=>array("target"=>'_blank'),
						'label'=>'View PDF',
						'visible'=>'$data->openTour',
				   ),
				   
           ),
		),
	),
)); ?>
			</div>
		</div>

		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  <script type="text/javascript">
	function newtourist() {
	document.forms['current-subscriber-form']['newrecord'].value=1;
	document.forms['current-subscriber-form'].submit();
	}
</script>