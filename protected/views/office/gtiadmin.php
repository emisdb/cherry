
 <?php $this->renderPartial('_top', array('info'=>$info)); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">

<h1>Booking</h1>	
       </section>


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
			<div class="col-md-3">
			<div class="form-group">
	<?php		echo $form->labelEx($model,'from_date',array('style'=>'margin-right:5px;')); 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'SegGuidestourinvoices[from_date]',
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
						'class'=>'form-control-date-filter',
 					),				
));
?>				
			</div>
			</div>
			<div class="col-md-3">
			<div class="form-group">
	<?php		echo $form->labelEx($model,'to_date',array('style'=>'margin-right:5px;')); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'SegGuidestourinvoices[to_date]',
				  'attribute'=>'to_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//    'name'=>'to_date',
 //    'value'=>Yii::app()->request->cookies['to_date']->value,
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
 
    ),
					'htmlOptions'=>array(
						'class'=>'form-control-date-filter',
 					),				
));
?>				
			</div>
			</div>
			<div class="col-md-6">
				<?php echo CHtml::submitButton('Filter',array('class'=>'btn btn-primary cancel')); // submit button ?> 
			</div>
		</div>
 <?php $this->endWidget(); ?>	
		<div class="row">
			<div class="col-md-12">

<?php 
    $datetime = time();
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gtiadmin-grid',
      'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),//$model->search_root(),
	'enablePagination'=>false,
	'filter'=>$model,
   'htmlOptions'=>array(
	'style'=>'padding-top: 0px;',
    ),
	'columns'=>array(
				array(
			'class'=>'CButtonColumn',
            'template'=>'{edit}',
			'htmlOptions'=>array("width"=>"80px"),
            'buttons' => array(
				   'edit' => array(
						'imageUrl'=>'/img/view.png',
						'url' => "array('sched','id'=>\$data->idseg_guidesTourInvoices)",
						'label'=>'Edit tour',
				   ),
/* 
 * 				   'delete' => array(
						'url' => 'array("deleteST","id"=>"$data->idseg_guidesTourInvoices")',				   
				   ),
				   'pdf' => array(
						'imageUrl'=>'/img/pdf.png',
						'url' => 'Yii::app()->createUrl("/filespdf/$data->sched->additional_info2.pdf")',
					   'options'=>array("target"=>'_blank'),
					'label'=>'View PDF',
				   ),
*/				   
           ),
		),
		'idseg_guidesTourInvoices',
		'custname',
		'custsname',
		'guidename',
		'cityname',
      array(
            'name'=>'contact.phone',	
                'type'=>'raw',
        'value'=>'CHtml::link($data->contact->phone, "tel:".$data->contact->phone)',
            'filter'=>false,
        ),	
      array(
            'name'=>'contact.email',	
                 'type'=>'raw',
        'value'=>'CHtml::link($data->contact->email, "mailto:".$data->contact->email)',
            'filter'=>false,
        ),	
		
      array(
            'name'=>'sched.date_now',	
            'value'=>'date("d.m.Y",$data->sched->date_now)',
            'filter'=>false,
             //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
       array(
            'name'=>'sched.starttime',
            'type'=>'raw',
           'value'=>"Yii::app()->dateFormatter->format('HH:mm',strtotime(\$data->sched->starttime))",
//   						'headerHtmlOptions'=>array('class'=>'info'),
         //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
 	      array(
            'name'=>'sched.tastring',	
            'value'=>'$data->sched->tastring',
            'filter'=>false,
         ),	
	      array(
            'name'=>'sched.isCanceled',	
            'value'=>'$data->sched->isCanceled',
            'filter'=>false,
         ),	
         array(
            'name'=>'countCustomers',
            'value'=>'$data->countCustomers."/".$data->sched->TNmax_sched',  
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
	      array(
            'name'=>'sched.trname',	
            'value'=>'$data->sched->trname',
            'filter'=>false,
             //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),	
	'langname'
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