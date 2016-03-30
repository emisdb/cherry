<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */
/* @var $form CActiveForm */
?>
   <div class="box box-info" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Erinnerungen
            </h4>
        </div>
        <div class="box-body" >
 	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'invoiceCount2013')."<p>"; 
					echo $form->radioButtonList($model,'invoiceCount2013', $model->getReminderOptions());
					echo $form->error($model,'invoiceCount2013'); 
				 ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'invoiceCount2014'); 
					echo $form->textField($model,'invoiceCount2014',array('class'=>"form-control"));
					echo $form->error($model,'invoiceCount2014'); 
				 ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'cancel_hours'); 
					echo $form->textField($model,'cancel_hours',array('class'=>"form-control"));
					echo $form->error($model,'cancel_hours'); 
				 ?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'cancel_number'); 
					echo $form->textField($model,'cancel_number',array('class'=>"form-control"));
					echo $form->error($model,'cancel_number'); 
				 ?>
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
 	<div class="row">
 		<div class="col-md-10">
			<div class="form-group">
                            <?php 
                                echo $form->labelEx($model,'guide_shorttext');
                                echo $form->textField($model,'guide_shorttext'); 
                                echo $form->error($model,'guide_shorttext');
                            ?>
			</div>

                <div class="form-group">
		<?php
                    echo $form->labelEx($model,'guide_maintext'); 
                    echo $form->textArea($model,'guide_maintext',array('rows'=>5, 'cols'=>100));
                    echo $form->error($model,'guide_maintext'); 
                  ?>
                </div>
                </div>
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
 	<div class="row">
  		<div class="col-md-10">
			<div class="form-group">
                            <?php 
                                echo $form->labelEx($model,'guide_shorttext_En');
                                echo $form->textField($model,'guide_shorttext_En'); 
                                echo $form->error($model,'guide_shorttext_En');
                            ?>
			</div>

                <div class="form-group">
		<?php
                    echo $form->labelEx($model,'guide_maintext_En'); 
                    echo $form->textArea($model,'guide_maintext_En',array('rows'=>5, 'cols'=>100));
                    echo $form->error($model,'guide_maintext_En'); 
                  ?>
                </div>
            </div>
            </div>
         
        </div>
    </div>
<div class="box box-info" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Files
            </h4>
        </div>
        <div class="box-body" >
 	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
 		<?php
                    echo $form->labelEx($model,'lnk_to_picture',array('style'=>'margin-right:10px;'));
                     if($model->lnk_to_picture !=""){
                        echo CHtml::image(Yii::app()->request->baseUrl.'/image/guide/'. $model->lnk_to_picture,'Guide\'s image',array('style'=>'height: 100px; width:100px;'));
                    }
                    echo $form->FileField($model,'image');
                    echo $form->error($model,'lnk_to_picture');
                  ?>
 		</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
 		<?php
                    echo $form->labelEx($model,'lnk_to_license',array('style'=>'margin-right:10px;'));
                    echo $form->textField($model,'lnk_to_license',array("disabled"=>"true")); 
                    echo CHtml::link("Open",array('/image/guide/'.$model->lnk_to_license),array("target"=>"_blank"));
                     echo $form->FileField($model,'doc');
                    echo $form->error($model,'lnk_to_license');
                  ?>
 		</div>
		</div>
 	</div>        
        </div>
    </div>
   </div>