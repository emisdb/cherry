<?php
/* @var $this SegContactsController */
/* @var $model SegContacts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-contacts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Felder mit einem <span class="required">*</span> müssen ausgefüllt werden.</p>

	<?php echo $form->errorSummary($model); ?>

   <div class="box box-primary" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Private Daten
            </h4>
        </div>
        <div class="box-body" >
 	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'firstname'); 
					echo $form->textField($model,'firstname',array('class'=>"form-control"));
					echo $form->error($model,'firstname'); 
				 ?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'surname'); 
					echo $form->textField($model,'surname',array('class'=>"form-control"));
					echo $form->error($model,'surname'); 
				 ?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
                    <?php 
			echo $form->labelEx($model,'birthdate');  
			 $this->widget('zii.widgets.jui.CJuiDatePicker',
			 array(
				  'name'=>'SegContacts[birthdate]',
				  'attribute'=>'birthdate', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//				  'value'=>$model->isNewRecord ? date('dd.mm.yy') : '',
				  'value'=>$model->isNewRecord ? date('yy-mm-dd') : '',
					'language'=>'de',
				 'htmlOptions'=>array(
				 'class'=>"form-control"),
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat' => 'yy-mm-dd',
 					),
					
//				  'fontSize'=>'0.8em'
				 )
			  );	
	
			echo $form->error($model,'birthdate'); 
			?>
			</div>
		</div>
	</div>
 	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
                            <?php	echo $form->labelEx($model,'phone'); 	 ?>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <?php
					echo $form->textField($model,'phone',array('class'=>'form-control',
                                                'data-inputmask'=>'"mask": "999(999) 999-9999"',
                                                 'data-mask'=>''
                                                                                ));
					echo $form->error($model,'phone'); 
				 ?>
	                        </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
                            <?php	echo $form->labelEx($model,'email'); 	 ?>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <?php
					echo $form->textField($model,'email',array('class'=>'form-control',
                                                                                'placeholder'=>'email',
                                                                                ));
					echo $form->error($model,'email'); 
				 ?>
	                        </div>
			</div>
		</div>
	</div>
           
        </div>
    </div>
   <div class="box box-primary" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Adresse
            </h4>
        </div>
        <div class="box-body" >
 	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'postalcode'); 
					echo $form->textField($model,'postalcode',array('class'=>'form-control','maxlength'=>'11'));
					echo $form->error($model,'postalcode'); 
				 ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'country'); 
					echo $form->textField($model,'country',array('class'=>"form-control"));
					echo $form->error($model,'country'); 
				 ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'city'); 
					echo $form->textField($model,'city',array('class'=>"form-control"));
					echo $form->error($model,'city'); 
				 ?>
			</div>
		</div>
 		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'street'); 
					echo $form->textField($model,'street',array('class'=>'form-control','maxlength'=>'11'));
					echo $form->error($model,'street'); 
				 ?>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'house'); 
					echo $form->textField($model,'house',array('class'=>"form-control"));
					echo $form->error($model,'house'); 
				 ?>
			</div>
		</div>
	</div>
  	<div class="row">
            <div class="col-md-12">
                <div class="form-group">
		<?php echo $form->labelEx($model,'additional_address'); ?>
		<?php echo $form->textField($model,'additional_address',array('size'=>45,'maxlength'=>45,'class'=>"form-control")); ?>
		<?php echo $form->error($model,'additional_address'); ?>
                </div>
            </div>
 	</div>
        
        </div>
    </div>
   <div class="box box-info" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Homepageauftritt Deutsch
            </h4>
        </div>
        <div class="box-body" >
               <div class="panel panel-default">
                 <div class="panel-heading">
                     <?php echo $form->labelEx($info['guide']['data'],'guide_shorttext'); ?>
                 </div>
                 <div class="panel-body"><?php echo $info['guide']['data']->guide_shorttext; ?></div>
               </div>
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <?php echo $form->labelEx($info['guide']['data'],'guide_maintext'); ?>
                 </div>
                 <div class="panel-body"><?php echo $info['guide']['data']->guide_maintext; ?></div>
               </div>

             </div>
        </div>

   <div class="box box-info" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Homepageauftritt Englisch
            </h4>
        </div>
         <div class="box-body" >
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <?php echo $form->labelEx($info['guide']['data'],'guide_shorttext_En'); ?>
                 </div>
                 <div class="panel-body"><?php echo $info['guide']['data']->guide_shorttext; ?></div>
               </div>
             <div class="panel panel-default">
                 <div class="panel-heading">
                     <?php echo $form->labelEx($info['guide']['data'],'guide_maintext_En'); ?>
                 </div>
                 <div class="panel-body"><?php echo $info['guide']['data']->guide_maintext; ?></div>
               </div>

                </div>
    </div>
	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo 'Speichern'; ?></button>
		<button class="btn btn-primary cancel"><?php echo CHtml::link("Abbrechen", array("profile")) ?></button>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->