<style>
	.table_scheduled_pdf,.grid-view table.items tbody tr.table_scheduled_pdf:hover{ background:red;  color:#fff; font-weight: bold; }
	.table_scheduled{ background:#eeeeee; }
</style>
<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
 		 <div class="modal modal-info fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Cashbox History</h4>
			   </div>
			   <div class="modal-body">
				 <div id="modal-data">This is the guide's info.</div>
			   </div>
			   <div class="modal-footer">
					<button  type="button" class="btn btn-outline pull-right btn-default" data-dismiss="modal">Close</button>
			   </div>
			 </div>
		   </div>
		 </div>
       <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>Cashbox history for user <?php echo $user['contact_ob']['firstname']." ".$user['contact_ob']['surname']; ?></h1>
      </section>

        <!-- Main content -->
        <section class="content">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'date-form',
    'htmlOptions'=>array(
	'name'=>'date-form',
    ),
//  'name'=>'date-form',
    'enableAjaxValidation'=>true,
)); ?>
		<div class="row">
			<div class="col-md-1">
				<b>From :</b>				
			</div>
			<div class="col-md-2">
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'CashboxChangeRequests[from_date]',
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
 				  'name'=>'CashboxChangeRequests[to_date]',
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




<?php
$dataProvider=$model->search();

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pay-grid',
	'dataProvider'=>$dataProvider,
   'rowCssClassExpression' => 'is_null($data->approvedBy) ? "table_scheduled_pdf" : "table_scheduled"', 
//      'ajaxUpdate'=>false,
//	'filter'=>$model,
        'htmlOptions'=>array(
        'style'=>'width:900px;'
    ),
	'columns'=>array(
		 array(
				'name'=>'request_date',
				'type'=>'raw',
				'value'=>"Yii::app()->dateFormatter->format('dd.MM.yyyy',\$data->request_date)",
				'filter'=>false, // Set the filter to false when date range searching
				),
			 array(
					'name'=>'approval_date',
					'type'=>'raw',
				'value'=>"Yii::app()->dateFormatter->format('dd.MM.yyyy',\$data->approval_date)",
					'filter'=>false, // Set the filter to false when date range searching
				),
		 array(
					'name'=>'approvedBy',
					'type'=>'raw',
					'value'=>"isset(\$data->apuser) ? \$data->apuser->username : '-'",
					'filter'=>false, // Set the filter to false when date range searching
			
			 ),
		 array(
					'name'=>'id_type',
					'type'=>'raw',
					'value'=>"isset(\$data->cashtype) ? \$data->cashtype->name : '-'",
					'filter'=>false, // Set the filter to false when date range searching
				'footer'=>'Total:',
			
			 ),
		'reason',
       array(
            'name'=>'delta_cash',
             'filter'=>false, // Set the filter to false when date range searching
                'type'=>'raw',
            'value'=>"Yii::app()->numberFormatter->formatCurrency(\$data->delta_cash, '')",
 // 			'filter'=>false, Set the filter to false when date range searching
			'htmlOptions'=>array('style' => 'text-align: right;'),
                        'footer'=>$model->getTotals($model->search()->getKeys()),
                       'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;text-align:right;'
                     ),
			   ),

		array(
		
				'class'=>'CButtonColumn',
				'template'=>'{pdf}{view}',
				'buttons' => array(
				   'view' => array(
						'imageUrl'=>'/img/view.png',
						'url' => 'Yii::app()->createUrl("/image/cashdocs/".$data->doc->link)',
//						'url' => '$data->sched->additional_info2',
					   'options'=>array("target"=>'_blank'),
						'label'=>'View file',
						'visible'=>'!is_null($data->doc)',
				   ),
				   'pdf' => array(
						'imageUrl'=>'/img/pdf.png',
						'url' => 'Yii::app()->createUrl("/filespdf/".$data->sched->additional_info2.".pdf")',
//						'url' => '$data->sched->additional_info2',
					   'options'=>array("target"=>'_blank'),
						'label'=>'View PDF',
						'visible'=>'$data->id_type==1 OR $data->id_type==2',
				   ),
				   
				),
		),	
            ),
));

 ?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

