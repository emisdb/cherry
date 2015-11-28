<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */
/* @var $form CActiveForm 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'css/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'css/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css' );
*/
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-scheduled-tours-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'idseg_scheduled_tours'); 
					echo $form->textField($model,'idseg_scheduled_tours',array('class'=>"form-control",'disabled'=>'true'));
					echo $form->error($model,'idseg_scheduled_tours'); 
				 ?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'city_id'); 
	//				echo $form->textField($model,'city_id');
					echo $form->textField($model->city_ob,'seg_cityname',array('class'=>"form-control",'disabled'=>'true'));
					echo $form->error($model,'city_id'); 
				 ?>
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'tourroute_id'); 
					echo $form->dropDownList($model,'tourroute_id', CHtml::listData (array_values($arrays[0]), 0, 1),
	                    array('empty'=>'--','id'=>'route','onChange'=>'do_route(value,0)'));
					echo $form->error($model,'tourroute_id');
				?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php 
					echo $form->labelEx($model,'language_id'); 
					echo $form->dropDownList($model,'language_id', CHtml::listData (array_values($arrays[1]), 0, 1),
						array('empty'=>'--','id'=>'language','onChange'=>'do_route(value,1)'));
					echo $form->error($model,'language_id');
					?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<?php
				 echo $form->labelEx($model,'guide1_id',array('style'=>'padding-right:5px'));
				 echo $form->dropDownList($model,'guide1_id', CHtml::listData (array_values($arrays[2]), 0, 1),
                        array('empty'=>'--','id'=>'guide','onChange'=>'do_route(value,2)'));
				 echo $form->error($model,'guide1_id'); 
			 ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
		<?php 
			echo $form->labelEx($model,'date');  
			 $this->widget('zii.widgets.jui.CJuiDatePicker',
			 array(
				  'name'=>'SegScheduledTours[date]',
				  'attribute'=>'date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
				  'value'=>$model->isNewRecord ? date('dd.mm.yy') : '',
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat' => 'dd.mm.yy',
 					),
					
//				  'fontSize'=>'0.8em'
				 )
			  );	
	
//			echo $form->textField($model,'date'); 
			echo $form->error($model,'date'); 
			?>
		</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php
				echo $form->labelEx($model,'starttime');
	$this->widget('ext.clockpick.EClockpick', array(
         'model'            => $model,
		'attribute'=>'starttime',
		
//         'name'        =>'timepick',
		 'value'=>'08:00',
         'options'          =>array(
     'starthour'=>8,
                'endhour'=>19,
                'event'=>'click',
                'showminutes'=>true,
                'minutedivisions'=>6,
                'military' =>true,
                'layout'=>'vertical',
                'hoursopacity'=>1,
                'minutesopacity'=>1,
			 ),
         'htmlOptions'      => array('size'=>10,
					'maxlength'=>10, 
			 )
    ));	
//	echo $form->textField($model,'starttime',array('class'=>"form-control timepicker"));
				echo $form->error($model,'starttime'); 
				?>
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
			<?php
					echo $form->labelEx($model,'TNmax_sched');
					echo $form->textField($model,'TNmax_sched',array("id"=>"maxsched"));
					echo $form->error($model,'TNmax_sched'); 
					?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<?php
						echo $form->labelEx($model,'duration');
						echo $form->textField($model,'duration'); 
						echo $form->error($model,'duration'); 
					?>
			</div>
		</div>
        <div class="col-md-3">
			<div class="form-group">
			<?php 
				echo $form->labelEx($model,'visibility'); 
				echo $form->textField($model,'visibility'); 
				echo $form->error($model,'visibility');
				?>
			</div>
		</div>
        <div class="col-md-3"></div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
			<?php
			echo $form->labelEx($model,'additional_info');
			 echo $form->textArea($model,'additional_info',array('size'=>60,'maxlength'=>1000)); 
			 echo $form->error($model,'additional_info');
			?>
			</div>
		</div>
        <div class="col-md-4"></div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="form-group">
			<?php
			echo $form->labelEx($model,'cancellationAnnotation');
			 echo $form->textArea($model,'cancellationAnnotation',array('size'=>60,'maxlength'=>1500)); 
			 echo $form->error($model,'cancellationAnnotation');
		   ?>
			</div>
		</div>
        <div class="col-md-4"></div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'isCanceled');
					echo $form->textField($model,'isCanceled');
					echo $form->error($model,'isCanceled');
				?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php 
					echo $form->labelEx($model,'cancelReason'); 
					echo $form->dropDownList($model,'cancelReason', CHtml::listData(CancellationReason::model()->findAll(),'id', 'name'),
						array('empty'=>'--','id'=>'canceltype','onChange'=>'clickcr(this.value)'));
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
       <div class="col-md-3"></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
 
