<?php
/* @var $this SegContactsController */
/* @var $model SegContacts */
/* @var $form CActiveForm */
?>
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
					echo $form->labelEx($model,'country'); 
					echo $form->textField($model,'country',array('class'=>"form-control"));
					echo $form->error($model,'country'); 
				 ?>
			</div>
		</div>
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
 