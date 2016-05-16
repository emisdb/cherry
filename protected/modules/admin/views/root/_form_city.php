<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'seg-cities-form',
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
     <div class="box box-primary" >
        <div class="box-header with-border">
            <h4 class="box-title">
           Names
            </h4>
        </div>
        <div class="box-body" >
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <?php echo $form->labelEx($model,'seg_cityname',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'seg_cityname',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'seg_cityname'); ?>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
            <?php echo $form->labelEx($model,'shortname',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'shortname',array('size'=>3,'maxlength'=>3,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'shortname'); ?>
            </div>
         </div>
       </div>
 	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
 		<?php
                    echo $form->labelEx($model,'picture_city',array('style'=>'margin-right:10px;'));
                     if($model->picture_city !=""){
                        echo CHtml::image(Yii::app()->request->baseUrl.'/img/'. $model->picture_city,'City\'s image',array('style'=>'height: 150px;'));
                    }
                    echo $form->FileField($model,'image');
                    echo $form->error($model,'picture_city');
                  ?>
 		</div>
		</div>  
    	</div>  
        </div>
    </div>
     <div class="box box-primary" >
        <div class="box-header with-border">
            <h4 class="box-title">
           Mails
            </h4>
        </div>
        <div class="box-body" >
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailInfo',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailInfo',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailInfo'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBuchungen',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBuchungen',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBuchungen'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBookings',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBookings',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBookings'); ?>
            </div>
         </div>
       </div>
       <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailVoucher',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailVoucher',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailVoucher'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailCancellation',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailCancellation',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailCancellation'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailInfoDisplayName',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailInfoDisplayName',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailInfoDisplayName'); ?>
            </div>
         </div>
       </div>
       <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBookingsDisplayName',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBookingsDisplayName',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBookingsDisplayName'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBuchungenDisplayName',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBuchungenDisplayName',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBuchungenDisplayName'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailVoucherDisplayName',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailVoucherDisplayName',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailVoucherDisplayName'); ?>
            </div>
         </div>
       </div>
       <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailCancellationDisplayName',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailCancellationDisplayName',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailCancellationDisplayName'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailInfoAccount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailInfoAccount',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailInfoAccount'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBuchungenAccount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBuchungenAccount',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBuchungenAccount'); ?>
            </div>
         </div>
       </div>
      <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBookingsAccount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBookingsAccount',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBookingsAccount'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailVoucherAccount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailVoucherAccount',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailVoucherAccount'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailCancellationAccount',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailCancellationAccount',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailCancellationAccount'); ?>
            </div>
         </div>
       </div>
     <div class="row">
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailInfoPW',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailInfoPW',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailInfoPW'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBuchungenPW',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBuchungenPW',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBuchungenPW'); ?>
            </div>
         </div>
          <div class="col-md-4">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailBookingsPW',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailBookingsPW',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailBookingsPW'); ?>
            </div>
         </div>
       </div>
     <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailVoucherPW',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailVoucherPW',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailVoucherPW'); ?>
            </div>
         </div>
          <div class="col-md-6">
            <div class="form-group">
            <?php echo $form->labelEx($model,'mailCancellationPW',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'mailCancellationPW',array('size'=>45,'maxlength'=>45,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'mailCancellationPW'); ?>
            </div>
         </div>
        </div>
        </div>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'webadress'); ?>
		<?php echo $form->textField($model,'webadress',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'webadress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localPhone'); ?>
		<?php echo $form->textField($model,'localPhone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'localPhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localStreet'); ?>
		<?php echo $form->textField($model,'localStreet',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'localStreet'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localHouse'); ?>
		<?php echo $form->textField($model,'localHouse',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'localHouse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localPLZ'); ?>
		<?php echo $form->textField($model,'localPLZ',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'localPLZ'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'webadress_en'); ?>
		<?php echo $form->textField($model,'webadress_en',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'webadress_en'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'cashaccount_DTV'); ?>
		<?php echo $form->textField($model,'cashaccount_DTV',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'cashaccount_DTV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tripadvisor_lnk'); ?>
		<?php echo $form->textField($model,'tripadvisor_lnk',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'tripadvisor_lnk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_lnk'); ?>
		<?php echo $form->textField($model,'facebook_lnk',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'facebook_lnk'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_analytics_id'); ?>
		<?php echo $form->textField($model,'google_analytics_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'google_analytics_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_id'); ?>
		<?php echo $form->textField($model,'google_conversions_id'); ?>
		<?php echo $form->error($model,'google_conversions_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_label'); ?>
		<?php echo $form->textField($model,'google_conversions_label',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'google_conversions_label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_analytics_id_booking_de'); ?>
		<?php echo $form->textField($model,'google_analytics_id_booking_de',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_analytics_id_booking_de'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_id_booking_de'); ?>
		<?php echo $form->textField($model,'google_conversions_id_booking_de',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_id_booking_de'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_label_booking_de'); ?>
		<?php echo $form->textField($model,'google_conversions_label_booking_de',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_label_booking_de'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_analytics_id_booking_en'); ?>
		<?php echo $form->textField($model,'google_analytics_id_booking_en',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_analytics_id_booking_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_id_booking_en'); ?>
		<?php echo $form->textField($model,'google_conversions_id_booking_en',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_id_booking_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'google_conversions_label_booking_en'); ?>
		<?php echo $form->textField($model,'google_conversions_label_booking_en',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'google_conversions_label_booking_en'); ?>
	</div>


	<div class="row buttons">
        <button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>cadmin"><?php echo 'Cancel'; ?></a></button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->