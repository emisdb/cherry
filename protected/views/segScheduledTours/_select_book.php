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
			
		</div>
	</div>
	<div class="row-filter">
				<?php
				echo $form->dropDownList($model,'city_id', CHtml::listData (SegCities::model()->findAll(),'idseg_cities', 'seg_cityname'),
					array('empty'=>'Wo geht es hin?','id'=>'pickcity','onChange'=>'do_city(value,0)'));
			?>
		<?php 
			 $this->widget('zii.widgets.jui.CJuiDatePicker',
			 array(
				  'name'=>'SegScheduledTours[date]',
				  'attribute'=>'date', // Model attribute filed which hold user input
				  'model'=>$model,            // Model name
//				  'value'=>$model->isNewRecord ? date('dd.mm.yy') : '',
//				  'value'=>$model->isNewRecord ? date('dd-mm-yy') : '',
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat' => 'dd.mm.yy',
					),
					'htmlOptions'=>array(
						'class'=>'form-control-date-filter',
 					),				
//				  'fontSize'=>'0.8em'
				 )
			  );	
	
//			echo $form->textField($model,'date'); 
			?>
	         	<button class="but-filter" type="submit"><?php echo 'SUCHE'; ?></button>
   	<?php // echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->