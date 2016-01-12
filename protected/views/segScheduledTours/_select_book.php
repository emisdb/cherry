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
									echo $form->dropDownList($model,'language_id', CHtml::listData (Languages::model()->findAll(),'id_languages', 'germanname'),
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
				<div class="col-md-6">
					<div class="form-group">
						<label for="input_name" class="control-label">Vor- und Nachname</label>
						<input type="text" id="input_name" class="form-control" placeholder="John Livingstone">
					  </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="input_country" class="control-label">Land</label>
						  <input type="text" id="input_country" class="form-control" placeholder="United States">
					  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="input_address" class="control-label">Stra&szlig;e, House-Nr.</label>
						<input type="text" id="input_address" class="form-control">
					  </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="input_tel" class="control-label">Telefon</label>
						  <input type="text" id="input_tel" class="form-control">
					  </div>
				</div>
			</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->