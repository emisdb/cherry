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
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'invoiceCount2013')."<p>"; 
					echo $form->radioButtonList($model,'invoiceCount2013', $model->getReminderOptions());
					echo $form->error($model,'invoiceCount2013'); 
				 ?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<?php
					echo $form->labelEx($model,'invoiceCount2014'); 
					echo $form->textField($model,'invoiceCount2014',array('class'=>"form-control"));
					echo $form->error($model,'invoiceCount2014'); 
				 ?>
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
        </div>
    </div>
   <div class="box box-info" >
        <div class="box-header with-border">
            <h4 class="box-title">
                Homepageauftritt
            </h4>
        </div>
        <div class="box-body" >
 	<div class="row">
		<div class="col-md-3">
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
            <div class="col-md-9">
			<div class="form-group">
                            <?php 
                                echo $form->labelEx($model,'guide_shorttext');
                                echo $form->textArea($model,'guide_shorttext',array('rows'=>6, 'cols'=>50)); 
                                echo $form->error($model,'guide_shorttext');
                            ?>
			</div>
		</div>
	</div>
  	<div class="row">
            <div class="col-md-12">
                <div class="form-group">
		<?php
                    echo $form->labelEx($model,'guide_maintext'); 
                    echo $form->textArea($model,'guide_maintext',array('rows'=>9, 'cols'=>50));
                    echo $form->error($model,'guide_maintext'); 
                  ?>
                </div>
            </div>
 	</div>
        
        </div>
    </div>
   </div>