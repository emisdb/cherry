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
				 <h4 class="modal-title">Anträge Kasseänderungen </h4>
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
<?php
$this->breadcrumbs=array(
    'Guides'=>array('admin'),
	CHtml::encode('Kassenverlauf für').$user['username']=>array('cashReport','id'=>$user['id'],'typo'=>0),
	CHtml::encode('Anträge Kasseänderungen'),
);
 $this->widget('zii.widgets.CBreadcrumbs', array(
        'links'=>$this->breadcrumbs,
        'homeLink'=>false,
        'tagName'=>'ul',
        'separator'=>'',
        'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
        'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
        'htmlOptions'=>array ('class'=>'breadcrumb')
    ));


?>
<h1>Antr&auml;ge Ka&szlig;eänderungen - <?php echo $user['contact_ob']['firstname']." ".$user['contact_ob']['surname']; ?></h1>
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
			<div class="col-md-3">
			<div class="form-group">
	<?php		echo $form->labelEx($model,'from_date',array('style'=>'margin-right:5px;')); 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
 				  'name'=>'CashboxChangeRequests[from_date]',
				  'attribute'=>'from_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
					'language'=>'de',
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
 				  'name'=>'CashboxChangeRequests[to_date]',
				  'attribute'=>'to_date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//    'name'=>'to_date',
 //    'value'=>Yii::app()->request->cookies['to_date']->value,
 							'language'=>'de',
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
				<?php echo CHtml::submitButton('Suchen',array('class'=>'btn btn-primary cancel')); // submit button ?> 
			</div>
		</div>
<?php $this->endWidget(); ?>	




<?php
$dataProvider=$model->search(1);

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pay-grid',
	'dataProvider'=>$dataProvider,
   'rowCssClassExpression' => '(is_null($data->approvedBy)&&($data->reject==0))? "table_scheduled_pdf" : "table_scheduled"', 
		'summaryText'=>'Insgesamt {count} Ergeibni&szlig;e',
 	'htmlOptions'=>array('class'=>'table-responsive'),
	'itemsCssClass'=>'table table-bordered',
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
//		 array(
//					'name'=>'id_type',
//					'type'=>'raw',
//					'value'=>"isset(\$data->cashtype) ? \$data->cashtype->name : '-'",
//					'filter'=>false, // Set the filter to false when date range searching
//				'footer'=>'Total:',
//			 ),
		'typename',
		 array(
					'name'=>'sched_user_id',
					'type'=>'raw',
					'value'=>"isset(\$data->tuser) ? \$data->tuser->contact_ob->firstname.' '.\$data->tuser->contact_ob->surname : '-'",
					'filter'=>false, // Set the filter to false when date range searching
				'footer'=>'Gesamt:',
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
				'template'=>'{view}',
				'buttons' => array(
				   'view' => array(
						'imageUrl'=>'/img/view.png',
						'url' => 'Yii::app()->createUrl("/image/cashdocs/".$data->doc->link)',
//						'url' => '$data->sched->additional_info2',
					   'options'=>array("target"=>'_blank'),
						'label'=>'Datei zeigen',
						'visible'=>'!is_null($data->doc)',
				   ),
				),
		),
		array(
		
				'class'=>'CButtonColumn',
				'template'=>'{approve}{reject}',
				'buttons' => array(
               'approve' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("cashApprove","id"=>$data->idcashbox_change_requests)',
                    'label'=>'<i class="fa fa-check-square-o" style="padding:0 3px;"></i>',
                    'options'=>array('title'=>'Approve'),
					 'visible' => '(is_null($data->approvedBy)&&($data->reject==0))', 
               ),
              'reject' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("cashReject","id"=>$data->idcashbox_change_requests)',
                    'label'=>'<i class="fa fa-square-o" style="padding:0 3px;"></i>',
                    'options'=>array('title'=>'Reject'),
					 'visible' => '(is_null($data->approvedBy)&&($data->reject==0))', 
               ),
				   
				),
		),	
            ),
));

 ?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

