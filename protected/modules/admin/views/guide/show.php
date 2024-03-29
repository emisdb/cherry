<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Show Tour',
);

?>
<?php  $date_format =  date('d.m.Y',$model->date_now);?>


<h2>
	Show Tour - <?php echo $model->idseg_scheduled_tours;?>
			- <?php echo $date_format;?>
			- <?php echo date( 'H:i', strtotime($model->starttime) );?> 
			- <?php if(isset($model->tourroute_ob)) echo $model->tourroute_ob->name;?>
			- <?php if(isset($model->city_ob)) echo $model->city_ob->seg_cityname;?>
			- <?php if(isset($model->language_ob)) echo $model->language_ob->englishname;?>
			- <?php echo "".$model->current_subscribers."(".$model->TNmax_sched.")";?>
</h2>
       </section>

        <!-- Main content -->
        <section class="content">
			<div class="table-responsive" >
				<table	class="table table-bordered">
					<thead>
						<tr class="info">
							<th>
								Name
							</th>
							<th>
								Last Name
							</th>
							<th>
								N of guests
							</th>
							<th>
								Phone
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
  <div class="panel-heading">Parameters</div>
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
  <div class="panel-heading">Tour cancellation</div>
  <div class="panel-body">

	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<?php
//						echo $form->labelEx($model,'isCanceled');
					echo "<div>".$form->labelEx($model,'isCanceled')."</div>";
					echo $form->checkBox($model,'isCanceled');
					echo $form->error($model,'isCanceled');
				?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php 
					echo $form->labelEx($model,'cancelReason'); 
					echo $form->dropDownList($model,'cancelReason', CHtml::listData(CancellationReason::model()->findAll(),'id', 'name'),
						array('empty'=>'--','class'=>'form-control'));
					echo $form->error($model,'cancelReason');
				?>
			</div>
		</div>
        <div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'cancellationReason');
					echo $form->textArea($model,'cancellationReason',array('size'=>60,'maxlength'=>250)); 
					echo $form->error($model,'cancellationReason');
				?>
			</div>
		
		</div>
       <div class="col-md-3" style="padding-top: 20px;">	
		   <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary cancel')); ?>
		</div>
	</div>
</div>
</div>
<?php $this->endWidget(); ?>
			<div class="row">
				<div class="col-md-2">
					<?php echo CHtml::link("Invoice", array("current","id_sched"=>$model->idseg_scheduled_tours), array( 'class'=>"btn btn-info" ,'role'=>"button"))?>
				</div>					
				<div class="col-md-2">
					<?php echo CHtml::link("Back", array("weeks","date"=>$date_format), array( 'class'=>"btn btn-primary" ,'role'=>"button"))?>
				</div>					
				<div class="col-md-8"></div>
			</div>	
	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  