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
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'tourroute_id'); 
//					echo $form->textField($model,'tourroute_id');  
					if($model->tourroute_id)
						echo $form->textField($model->tourroute_ob,'name',array('class'=>"form-control",'disabled'=>'true'));
					else 
						echo $form->dropDownList($model,'tourroute_id', CHtml::listData ($routs, 0, 1),
                                                        array('empty'=>'--','id'=>'route','onChange'=>'do_route(value)'));
					
					echo $form->error($model,'tourroute_id');
				?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php 
					echo $form->labelEx($model,'language_id'); 
//					echo $form->textField($model,'language_id');
					if($model->language_id)
						echo $form->textField($model->language_ob,'englishname',array('class'=>"form-control",'disabled'=>'true'));
					else 
                                            echo $form->dropDownList($model,'language_id', CHtml::listData ($languages, 0, 1),
                                                        array('empty'=>'--','id'=>'language','onChange'=>'do_lang(value)'));
					echo $form->error($model,'language_id');
					?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php
				 echo $form->labelEx($model,'guide1_id',array('style'=>'padding-right:5px'));
				 echo $form->dropDownList($model,'guide1_id', CHtml::listData ($guides, 0, 1),
                                                 array('empty'=>'--','id'=>'guide','onChange'=>'do_guide(value)'));
			
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
		<div class="col-md-4">
			<div class="form-group">
                		<?php
                                echo $form->labelEx($model,'TNmax_sched');
                                echo $form->textField($model,'TNmax_sched');
                                echo $form->error($model,'TNmax_sched'); 
                                ?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
                		<?php
                                    echo $form->labelEx($model,'duration');
                                    echo $form->textField($model,'duration'); 
                                    echo $form->error($model,'duration'); 
                                ?>
			</div>
		</div>
                <div class="col-md-4"></div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
                		<?php
                                     echo $form->labelEx($model,'additional_info');
                                      echo $form->textArea($model,'additional_info',array('size'=>60,'maxlength'=>1000)); 
                                      echo $form->error($model,'additional_info');
                                ?>
			</div>
		</div>
               <div class="col-md-6"></div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->textField($model,'visibility'); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'additional_info2'); ?>
		<?php echo $form->textField($model,'additional_info2',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'additional_info2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isCanceled'); ?>
		<?php echo $form->textField($model,'isCanceled'); ?>
		<?php echo $form->error($model,'isCanceled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancellationReason'); ?>
		<?php echo $form->textField($model,'cancellationReason',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cancellationReason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cancellationAnnotation'); ?>
		<?php echo $form->textField($model,'cancellationAnnotation',array('size'=>60,'maxlength'=>1500)); ?>
		<?php echo $form->error($model,'cancellationAnnotation'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
 
