<style>
	.table_scheduled_pdf,.grid-view table.items tbody tr.table_scheduled_pdf:hover{ background:red;  color:#fff; font-weight: bold; }
	.table_scheduled{ background:#eeeeee; }
	.cell_green{ background-color:#46a546; color:#000; }
	.cell_yellow{ background:#FFE495; color:#000; }
</style>
<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
 					<?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'cashbox-change-requests-form',
						'enableAjaxValidation'=>false,
//						'htmlOptions'=>array('enctype'=>'multipart/form-data'),
					)); ?>
		 <div class="modal modal-success fade" id="payModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Enter sum</h4>
			   </div>
			   <div class="modal-body">
				 <div id="modal-data">
			<p class="note"><span class="required">*</span> positiver Betrag erhöht den Kassenbestand vom Guide</p>
			<div class="row">
						<div class="col-md-6">
							<?php
//								echo $form->labelEx($cash_model,'delta_cash'); 
								echo chtml::label("Geldbetrag*", "CashboxChangeRequests_delta_cash");
								echo $form->textField($cash_model,'delta_cash',array('style'=>'color:#000;'));
								echo $form->error($cash_model,'delta_cash'); 
								echo $form->hiddenField($cash_model,'id_users');
								?>
						</div>
						<div class="col-md-6">
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
						<?php 
//							echo $form->labelEx($cash_model,'reason');
							echo chtml::label("Informationen", "CashboxChangeRequests_reason");
							echo $form->textField($cash_model,'reason',array('size'=>60,'maxlength'=>255,'style'=>'color:#000;')); 
							echo $form->error($cash_model,'reason');
						?>
					</div>
					<div class="col-md-2">
					</div>
					</div>				 
				 </div>
			   </div>
			   <div class="modal-footer">
					<div class="row buttons">
						<button class="btn btn-success btn-outline btn-default" type="submit">Speichern</button>
						<button  type="button" class="btn  pull-right" data-dismiss="modal">Abbrechen</button>
					</div>
			   </div>
			 </div>
		   </div>
		 </div>
       <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>Guides</h1>

<div class="create">
	<?php   echo CHtml::link('Neuen Guide anlegen', array('userCreate')); ?>
 </div>
	<?php
 	if($cash_model->hasErrors())
	{
		echo '<div class="callout callout-danger">'.$form->errorSummary($cash_model).'</div>';
	}
	?>
       </section>
				<?php $this->endWidget(); ?>
		
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
	'htmlOptions'=>array('class'=>'table-responsive'),
	'itemsCssClass'=>'table table-bordered',
		'summaryText'=>'Zeigt {start} - {end} von {count} Einträgen',
	'filter'=>$model,
	'columns'=>array(
/*
 *         array(
            'name'=>'role_ob',
            'value'=>'$data->role_ob->groupname',
            'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
            ),
*/ 
		'id',
		'guidename',
		        array(
            'name'=>'status',
			'value'=>array($model,'statuslabel'),
 				'footer'=>'Gesamt:',
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
                        'footer'=>$model->getTotals($model->search_office()->getKeys()),
                       'footerHtmlOptions'=>array(
                           'style'=>'font-style:normal; color:#000;text-align:right;'
                     ),
								  ),
				array(
                'class'=>'CButtonColumn',
                'template'=>'{update}{pwd}{cash}{cash_ap}{cash_give}',
                'htmlOptions' => array('style'=>'width:110px;'),
                'buttons' => array(
                'update' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("userUpdate", "id" => $data->id)',
                    'label'=>'Guideprofil',
               ),
                'pwd' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("ucontact","id_user"=>$data->id)',
                    'label'=>'<i class="fa fa-user" style="padding:0 3px;"></i>',
                    'options'=>array('title'=>'Kontaktdaten'),
               ),
                'cash' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("cashReport","id"=>$data->id)',
                    'label'=>'<i class="fa fa-credit-card" style="padding:0 3px;"></i>',
                    'options'=>array('title'=>'Kaßenverlauf'),
               ),
               'cash_ap' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("cashReport","id"=>$data->id,"typo"=>1)',
                    'label'=>'<i class="fa fa-check-square-o" style="padding:0 3px;"></i>',
                    'options'=>array('title'=>'Anträge Kaßeänderungen'),
               ),
                'delete' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'array("userDelete", "id" => $data->id)',
               ),
               'cash_give' => array(
                     //'imageUrl'=>'/images/system/proc.png',
//                    'url' => 'array("cashGive","id"=>$data->id)', 
                    'label'=>'<i class="fa fa-arrow-circle-left" style="padding:0 3px;"></i>',
			         'options'=>array('title'=>'Geld schicken','data-toggle'=>'modal','data-target'=>'#payModal','onclick'=>'clickPay(this);',
           ),
               ),
             ),
            ),
	),
)); ?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<script type="text/javascript">
	function clickPay(obj){
		var id=parseInt($(obj).parents('tr').find("td:eq(0)").text());
		var name=$(obj).parents('tr').find("td:eq(1)").text();
//		document.forms['cashbox-change-requests-form']['id_users'].value=id;
		$("h4.modal-title").text("Geld an  "+name+" schicken");
		$("#CashboxChangeRequests_id_users").val(id);
	}
</script> 