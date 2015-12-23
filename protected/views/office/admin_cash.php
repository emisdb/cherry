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

<h1>Cashbox  history for the Company</h1>
      </section>
       <section class="content">

<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */


$this->menu=array(
	array('label'=>'List CashboxChangeRequests', 'url'=>array('index')),
	array('label'=>'Create CashboxChangeRequests', 'url'=>array('create')),
);


?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cashbox-change-requests-grid',
	'dataProvider'=>$model->search_full(),
   'rowCssClassExpression' => 'is_null($data->approvedBy) ? "table_scheduled_pdf" : "table_scheduled"', 
    'summaryText' => "Starting balance:".Yii::app()->numberFormatter->formatCurrency($cashnow, ''),
	'filter'=>$model,
       'htmlOptions'=>array(
        'style'=>'width:1000px;'
    ),
	'columns'=>array(
		'idcashbox_change_requests',
			 array(
					'name'=>'sched',
					'type'=>'raw',
					'value'=>"\$data->id_type<3 ? \$data->sched->tastring : '-'",
					'filter'=>true, // Set the filter to false when date range searching
			
			 ),
		'cityname',
	 array(
                        'name'=>'request_date',
                        'type'=>'raw',
                        'value'=>"Yii::app()->dateFormatter->format('dd.MM.yyyy',\$data->request_date)",
                        'filter'=>true, // Set the filter to false when date range searching
				),
	 array(
                        'name'=>'request_date',
                        'type'=>'raw',
                        'header'=>'Zeit',
                        'value'=>"Yii::app()->dateFormatter->format('HH:mm',\$data->request_date)",
                        'filter'=>false, // Set the filter to false when date range searching
 				),
		'guidename',
		'id_type',
		'delta_cash',
		'reason',
		'approvedBy',
		'request_date',
		'approval_date',
		/*
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>


</section><!-- /.content -->
      </div><!-- /.content-wrapper -->