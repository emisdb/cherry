<?php

$this->breadcrumbs=array(
	'Scheduled Tours'=>array('admin'),
	'Spontaneous tour',
);

?>

<h1>Spontaneous tour</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-scheduled-tours-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="row-form">
    <!--	<php echo $form->labelEx($model,'date_now'); ?>
		< $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'date_now',
			'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat' => 'dd.mm.yy',
                        'yearRange' => '2015:2020',
                        //'changeMonth' => true,
                        //'changeYear' => true,
                        'minDate' => 0, 
                      //  'defaultDate'=> time(),   
						'dateonly' => true,  
                        //'maxDate' => '2099-12-31',  
                        // 'onSelect'=> 'js: function(date) {if(date != "") { 
                        //    window.location.href = "'.CHtml::encode($this->createUrl('segScheduledtours/weeks'
                        //    )).'/date/"+date ;
                        // } }',
            ),
            'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
				'class'=>'form-control-date-filter',
            ),
        ));?>
    </div>-->
    <?php echo $form->labelEx($model,'date_now'); ?>
    <?php $this->widget ('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',
                array(
                    'model'=>$model, //Model object
                    'attribute'=>'date_time', //attribute name
                    'mode'=>'datetime', //use "time","date" or "datetime" (default)
                    'language'=>'',
                    'options'=>array(
                            'regional'=>'',
							// 'showAnim'=>'fold',
                        'dateFormat' => 'dd.mm.yy',
						'timeFormat'=> 'hh:mm',
                        'yearRange' => '2015:2020',
                        //'changeMonth' => true,
                        //'changeYear' => true,
                        'minDate' => 0, 
					//	'minTime' => 0,
						'showAnim' =>'slide',
                      //  'defaultDate'=> time(),   
						//'dateonly' => true,  
                        ) // jquery plugin options
            ));
        ?>
    </div>

	
<!--
	<div class="row-form">
		<php echo $form->labelEx($model,'duration'); ?>
		<php echo $form->textField($model,'duration'); ?>
		<php echo $form->error($model,'duration'); ?>
	</div>
    -->
    
    
     

    	



	

	<div class="row buttons">
      	<button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segScheduledTours/officeadmin"><?php echo 'Cancel'; ?></a></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->