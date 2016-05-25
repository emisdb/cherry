
 <?php $this->renderPartial('_top', array('info'=>$info)); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">

<h1>Buchung <?php echo $pk.";"; ?></h1>	
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
 				  'name'=>'SegGuidestourinvoices[to_date]',
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
            	 <div class="modal modal-success fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
 			 <div class="modal-content">
			   <div class="modal-header">
				 <h4 class="modal-title">Invoice info</h4>
			   </div>
			   <div class="modal-body">
 					<div class="row">
						<div class="col-md-10">
						<?php 
//							echo $form->labelEx($cash_model,'reason');
							echo chtml::label("Informationen", "SegGuidestourinvoices_info");
							echo $form->textArea($model,'info',array('size'=>60,'maxlength'=>128,'style'=>'color:#000;')); 
							echo $form->error($model,'info');
							echo $form->hiddenField($model,'idseg_guidesTourInvoices');
						?>
					</div>
					<div class="col-md-2">
					</div>
					</div>	                                
			   </div>
			   <div class="modal-footer">
                                        <button class="btn btn-success btn-outline btn-default" type="submit">Speichern</button>
                                        <button  type="button" class="btn  pull-right" data-dismiss="modal" onclick="js:jQuery('#SegGuidestourinvoices_idseg_guidesTourInvoices').html('');">Abbrechen</button>
                            </div>
			 </div>
		   </div>
		 </div>

 <?php $this->endWidget();  ?>	
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
	'summaryText'=>'Zeigt von {count} Einträgen',

	'htmlOptions'=>array('class'=>'table-responsive'),
	'itemsCssClass'=>'table table-bordered',
 	'columns'=>array(
				array(
			'class'=>'CButtonColumn',
            'template'=>'{edit}{update}',
			'htmlOptions'=>array("style"=>"width:120px;padding:2px;"),
            'buttons' => array(
				   'edit' => array(
						'imageUrl'=>'/img/view.png',
						'url' => "array('sched','id'=>\$data->sched->idseg_scheduled_tours)",
						'label'=>'Anderung tour',
				   ),
					'update' => array(
						'url' => "array('invoice','id'=>\$data->idseg_guidesTourInvoices)",
						'label'=>'Rechnung',
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
	      array(
            'name'=>'cityname',	
              'filter'=>CHtml::listData(SegCities::model()->findAll(),'idseg_cities', 'seg_cityname'), 
        ),	
//		'cityname',
      array(
            'name'=>'phone',	
                'type'=>'raw',
        'value'=>'CHtml::link($data->contact->phone, "tel:".$data->contact->phone)',
//            'filter'=>true,
        ),	
      array(
            'name'=>'email',	
                 'type'=>'raw',
        'value'=>'CHtml::link($data->contact->email, "mailto:".$data->contact->email)',
        ),	
      array(
            'name'=>'info',	
                 'type'=>'raw',
//        'value'=>'(is_null($data->info)||(!(strlen($data->info)>0)))? CHtml::link( "__","js:void(0);",array("id"=>"inf".$data->idseg_guidesTourInvoices)): CHtml::link( substr($data->info,0,5),"js:void(0);",array("id"=>"inf".$data->idseg_guidesTourInvoices))',
        'value'=>array($model,'showinfo'),
              'filter'=>false,
         ),	
	
      array(
            'name'=>'sched.date_now',	
            'value'=>'date("d.m.Y",$data->sched->date_now)',
            'filter'=>false,
        ),
/*       array(
            'name'=>'sched.starttime',
            'type'=>'raw',
           'value'=>"Yii::app()->dateFormatter->format('HH:mm',strtotime(\$data->sched->starttime))",
//   						'headerHtmlOptions'=>array('class'=>'info'),
       ), 
 * 	      array(
            'name'=>'sched.tastring',	
            'value'=>'$data->sched->tastring',
            'filter'=>false,
         ),	
	      array(
            'name'=>'sched.isCanceled',	
            'value'=>'$data->sched->isCanceled',
            'filter'=>false,
         ),	

  */
		'stime',
		'TA_string',
		'cancel',
         array(
            'name'=>'countCustomers',
            'value'=>'$data->countCustomers."/".$data->sched->TNmax_sched',  
            //'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),
	      array(
            'name'=>'trname',	
              'filter'=>CHtml::listData(TourCategories::model()->findAll(),'id_tour_categories', 'name'),
        ),	
	      array(
            'name'=>'langname',	
              'filter'=>CHtml::listData(Languages::model()->findAll(),'id_languages', 'germanname'),
        ),	
//	'langname'
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