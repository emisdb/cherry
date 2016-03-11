
    <!-- Content Wrapper. Contains page content -->
      <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="header">

<?php  $date_format =  date('d.m.Y',$model->date_now);?>


<h3>
	Zeige Tour - <?php echo $model->idseg_scheduled_tours;?>
			- <?php echo $date_format;?>
			- <?php echo date( 'H:i', strtotime($model->starttime) );?> 
			- <?php if(isset($model->tourroute_ob)) echo $model->tourroute_ob->name;?>
			- <?php echo $model->city_id_all;?>
			- <?php if(isset($model->language_ob)) echo $model->language_ob->englishname;?>
			- <?php echo "".$model->current_subscribers."(".$model->TNmax_sched.")";?>
</h3>
       </section>

        <!-- Main content -->
        <section class="content">
			<div class="table-responsive" >
				<table	class="table table-bordered">
					<thead>
						<tr style="background-color: #003bb3;">
							<th>
								Vorname
							</th>
							<th>
								Nachname
							</th>
							<th>
								Gästeanzahl
							</th>
							<th>
								Telefon
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($model->guidestourinvoices as $value) {
							echo "<tr><td>".$value->contact->firstname."</td>";
							echo "<td>".$value->contact->surname."</td>";
							echo "<td>".$value->countCustomers."</td>";
							echo "<td>".  CHtml::link($value->contact->phone, "tel:".$value->contact->phone)."</td></tr>";
						}
						?>
					</tbody>
				</table>
			</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-scheduled-tours-form',
	'action'=>array("show","id"=>$model->idseg_scheduled_tours),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
		<div class="row">
		<div class="col-md-8">
			<div class="form-group">
			<?php
			echo $form->labelEx($model,'cancellationAnnotation',array('class'=>"control-label"));
			 echo $form->textArea($model,'cancellationAnnotation',array('size'=>60,'maxlength'=>1500,'class'=>"form-control",'disabled'=>"true")); 
		   ?>
			</div>
		</div>
        <div class="col-md-4"></div>
	</div>
<div class="panel panel-default">
  <div class="panel-heading">Parameter</div>
  <div class="panel-body">

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<?php 
					echo $form->labelEx($model,'language_id'); 
					echo $form->dropDownList($model,'language_id', $model->getLangList(),
						array('empty'=>'--','id'=>'language','onChange'=>'do_route(value,1)','class'=>'form-control'));
					echo $form->error($model,'language_id');
					?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<?php
				 echo $form->labelEx($model,'guide1_id',array('style'=>'padding-right:5px'));
				 echo $form->dropDownList($model,'guide1_id', $model->getGuideList(),
                        array('id'=>'guide','onChange'=>'do_route(value,2)','class'=>'form-control'));
				 echo $form->error($model,'guide1_id'); 
			 ?>
			</div>
		</div>
	</div>
</div>
</div>
			
<div class="panel panel-default">
  <div class="panel-heading">Tour Stornierung</div>
  <div class="panel-body">

	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<?php
//						echo $form->labelEx($model,'isCanceled');
					echo "<div>".$form->labelEx($model,'isCanceled')."</div>";
//					echo $form->labelEx($model,'isCanceled');
//					echo $form->checkBox($model,'isCanceled',array('class'=>'form-control'));
					echo $form->checkBox($model,'isCanceled');
					echo $form->error($model,'isCanceled');
				?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php 
					echo $form->labelEx($model,'cancelReason'); 
					echo $form->dropDownList($model,'cancelReason', CHtml::listData(CancellationReason::model()->findAll(),'id', 'name'),
						array('empty'=>'--','class'=>'form-control'));
					echo $form->error($model,'cancelReason');
				?>
			</div>
		</div>
        <div class="col-md-5">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'cancellationReason');
					echo $form->textArea($model,'cancellationReason',array('size'=>60,'maxlength'=>250,'class'=>'form-control')); 
					echo $form->error($model,'cancellationReason');
				?>
			</div>
		
		</div>
 	</div>
</div>
</div>
<?php $this->endWidget(); ?>
			<div class="row">
				<div class="col-md-3">
				   <?php echo CHtml::submitButton('Speichern',array('class'=>'btn btn-primary cancel','style'=>'margin:0;')); ?>
				</div>					
				<div class="col-md-3">
					<?php echo CHtml::link("Rechnung", array("current","id_sched"=>$model->idseg_scheduled_tours), array( 'class'=>"btn btn-info" ,'role'=>"button"))?>
				</div>					
				<div class="col-md-6"></div>
			</div>	
	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  