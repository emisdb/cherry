<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */
/* @var $form CActiveForm */
?>

<div class="booking-form">

<?php $form=$this->beginWidget('CActiveForm', array(
//	'action'=>array("city"),
	'method'=>'post',
)); ?>
	<div class="row title">
		<div class="col-md-2">1.</div>
		<div class="col-md-10">AUSWAHL &Uuml;BERPR&Uuml;FEN</div>
	</div>
	<div class="row">
		<div class="col-md-3">
	       <?php echo CHtml::image(Yii::app()->request->baseUrl."/image/guide/".$model->user_ob->guidepic, "User Image", array("class"=>"img-circle",'height'=>'90px','style'=>'margin:5px 0;')) ; ?>
			<div>
				<?php echo CHtml::encode($model->user_ob->guidename); ?>
			</div>
	<div>
		<?php 
		$tnmax=$tour['TNmax'];
//		var_dump($tour);
		if($tnmax>0)
		{
			$iibreak=round($tnmax/2);
			echo '<div class="manline">'; 
			for($ii=0;$ii<$tnmax;$ii++){
			if($ii==$iibreak) echo '</div><div class="manline">';
			if($ii<$model->current_subscribers)
				 echo CHtml::image(Yii::app()->request->baseUrl."/img/man_y.png", "yes man") ; 
			else
				 echo CHtml::image(Yii::app()->request->baseUrl."/img/man_n.png", "no man") ; 
		}
		if($ii>6) echo "</div>";
		$rest=$tnmax;
			if($model->current_subscribers>0) $rest=$tnmax-$model->current_subscribers;
			echo '<div style="margin-top:4px;text-align: center;width:100%">'.$rest." freie Pl&auml;tze</div>"; 
			}	
		?>
	</div>

		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="input_city" class="control-label">Stadt</label>
						<input type="text" id="input_city" class="form-control" disabled="true" value="<?php echo $model->city_ob->seg_cityname; ?>">
					  </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="input_tour" class="control-label">Tour</label>
						  <input type="text" id="input_tour" class="form-control" disabled="true" value="<?php echo $tour->tour_categories->name."".$model->openTour; ?>">
					  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="input_date" class="control-label">Date</label>
						  <input type="text" id="input_date" class="form-control" disabled="true" value="<?php echo $model->date; ?>">
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="input_time" class="control-label">Zeit</label>
						  <input type="text" id="input_time" class="form-control" disabled="true" value="<?php echo $model->starttime; ?>">
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="pick_lang" class="control-label">Sprache</label>
						<?php
							if(is_null($model->language_id)){
									echo $form->dropDownList($model,'language_id', CHtml::listData (SegLanguagesGuides::model()->with('languages')->findAll('users_id='.$model->guide1_id),'languages_id', 'languages.germanname'),
										array('id'=>'pick_lang', 'class'=>'form-control'));
								
							}
							 else 
							{
									echo '<input type="text" id="pick_lang" disabled="true" class="form-control" value="'.$model->language_ob->germanname.'">';
							}
						?>
					  </div>
				</div>
			</div>
				
 			
		</div>
	</div>
	<div class="row title">
		<div class="col-md-2">2.</div>
		<div class="col-md-10">DATEN EINGEBEN</div>
	</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'firstname',array('class'=>'control-label')); 
							echo $form->textField($contact,'firstname',array('class'=>'form-control','placeholder'=>'John',));
							echo $form->error($contact,'firstname'); 
						 ?>
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'surname',array('class'=>'control-label')); 
							echo $form->textField($contact,'surname',array('class'=>'form-control','placeholder'=>'Livingstone',));
							echo $form->error($contact,'surname'); 
						 ?>
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'country',array('class'=>'control-label')); 
							echo $form->textField($contact,'country',array('class'=>'form-control',));
							echo $form->error($contact,'country'); 
						 ?>
					  </div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'street',array('class'=>'control-label')); 
							echo $form->textField($contact,'street',array('class'=>'form-control'));
							echo $form->error($contact,'street'); 
						 ?>
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'phone',array('class'=>'control-label')); 
							echo $form->textField($contact,'phone',array('class'=>'form-control',
												'data-inputmask'=>'"mask": "999(999) 999-9999"',
                                                 'data-mask'=>''));
							echo $form->error($contact,'phone'); 
						 ?>
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
	<?php
							echo $form->labelEx($contact,'postalcode',array('class'=>'control-label')); 
							echo $form->textField($contact,'postalcode',array('class'=>'form-control'));
							echo $form->error($contact,'postalcode'); 
						 ?>
									  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'city',array('class'=>'control-label')); 
							echo $form->textField($contact,'city',array('class'=>'form-control'));
							echo $form->error($contact,'city'); 
						 ?>
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'email',array('class'=>'control-label')); 
							echo $form->textField($contact,'email',array('class'=>'form-control'));
							echo $form->error($contact,'email'); 
						 ?>
					  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<?php
							echo $form->labelEx($contact,'additional_address',array('class'=>'control-label')); 
							echo $form->textField($contact,'additional_address',array('size'=>45,'maxlength'=>45,'class'=>"form-control"));
							echo $form->error($contact,'additional_address'); 
						 ?>
					</div>
				</div>
			</div>
	<div class="row title">
		<div class="col-md-2">3.</div>
		<div class="col-md-10">TOUR BUCHEN</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<?php
				$arr=array();
				$model->current_subscribers=1;
				for($ii=0;$ii<$rest;$ii++) $arr[$ii+1]=$ii+1;
					echo $form->labelEx($model,'current_subscribers',array('class'=>'control-label')); 
					echo $form->dropDownList($model,'current_subscribers', $arr,
					array('class'=>'form-control','onchange'=>'clickTickets()'));
				?>
			</div>
		</div>
		<div class="col-md-3">
			<?php
				echo	'<div>St&uuml;ck zu je.</div><div>'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_euro.svg','euro',array('style'=>'height: 30px; width:50px;')).
					'<span id="base_price">'.number_format($tour->base_price, 2, '.', ' ').'</span></div>';
		?>
		</div>
		<div class="col-md-3">
			<?php
				echo	'<div>Gesamt inkl. Mvst.</div><div>'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_euro.svg','euro',array('style'=>'height: 30px; width:50px;')).
					'<span id="total_price">'.number_format($tour->base_price, 2, '.', ' ').'</span></div>';
		?>
			
		</div>
		<div class="col-md-3">
		<?php echo CHtml::submitButton('JETZT BUCHEN',array('class'=>'btn btn-success','style'=>'color:#fff;')); ?>
		</div>
	
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<script type="text/javascript">
	function clickTickets(){
        var element = document.getElementById('SegScheduledTours_current_subscribers').value ;
       var base_price = document.getElementById('base_price').innerHTML;
       var new_price = base_price*element;
		document.getElementById('total_price').innerHTML=new_price.toFixed(2);
	}
</script> 