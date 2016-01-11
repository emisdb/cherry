<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */
/* @var $form CActiveForm */
?>

<div class="wide-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>array("city"),
	'method'=>'post',
)); ?>
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