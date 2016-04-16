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

<h1>Kaßenverlauf</h1>
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
$dataProvider=$model->search();
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pay-grid',
	'dataProvider'=>$dataProvider,
     'summaryText' => "Ausgangsbetrag: ".Yii::app()->numberFormatter->formatCurrency($this->totval, ''),
//      'ajaxUpdate'=>false,
//	'filter'=>$model,
 	'itemsCssClass'=>'table table-bordered',
	'htmlOptions'=>array('class'=>'table-responsive',
       'style'=>'width:900px;'
    ),
	'columns'=>array(
		 array(
					'name'=>'idcashbox_change_requests',
					'type'=>'raw',
					'value'=>"'<a name=\"p_'.\$data->idcashbox_change_requests.'\">'.\$data->idcashbox_change_requests.'</a>'",
					'filter'=>false, // Set the filter to false when date range searching
				),
		 array(
                        'name'=>'request_date',
                        'type'=>'raw',
                        'value'=>"Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm',\$data->request_date)",
                        'filter'=>false, // Set the filter to false when date range searching
                        'footer'=>'Gesamt:',
				),
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
            'name'=>'delta_cash',
            'header'=>'Nachher',
             'filter'=>false, // Set the filter to false when date range searching
                'type'=>'raw',
//            'value'=>array($this,'adding'),
            'value'=>array($this,'minusing'),
 // 			'filter'=>false, Set the filter to false when date range searching
			'htmlOptions'=>array('style' => 'text-align: right;'),
//                        'footer'=>Yii::app()->numberFormatter->formatCurrency($this->totval, ''),
                       'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;text-align:right;'
                     ),
			   ),
		 array(
					'name'=>'id_type',
					'type'=>'raw',
					'value'=>"isset(\$data->cashtype) ? \$data->cashtype->name : '-'",
					'filter'=>false, // Set the filter to false when date range searching
			
			 ),
		 array(
					'name'=>'sched',
					'type'=>'raw',
					'value'=>"\$data->id_type<3 ? \$data->sched->tastring : '-'",
					'filter'=>false, // Set the filter to false when date range searching
			
			 ),
		 array(
					'name'=>'approvedBy',
					'type'=>'raw',
					'value'=>"isset(\$data->apuser) ? \$data->apuser->username : '-'",
					'filter'=>false, // Set the filter to false when date range searching
			
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
						'label'=>'Datei zeigen',
						'visible'=>'!is_null($data->doc)',
				   ),
				   'pdf' => array(
						'imageUrl'=>'/img/pdf.png',
						'url' => 'Yii::app()->createUrl("/filespdf/".$data->sched->additional_info2.".pdf")',
//						'url' => '$data->sched->additional_info2',
					   'options'=>array("target"=>'_blank'),
						'label'=>'PDF anzeigen',
						'visible'=>'$data->id_type==1 OR $data->id_type==2',
				   ),
				   
				),
		),	)
));

 ?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

