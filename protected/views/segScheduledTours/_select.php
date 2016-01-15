<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */
/* @var $form CActiveForm */
?>

<div class="wide-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
	<div class="row-filter">
		<div class="form-group">
				<?php
				echo $form->dropDownList($model,'city_id', CHtml::listData (SegCities::model()->findAll(),'idseg_cities', 'seg_cityname'),
					array('id'=>'pickcity','onChange'=>'do_city(value,0)'));
			?>
		</div>
	</div>
	<div class="row-filter">
			<div class="form-group">
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
		</div>
	</div>
	<div class="row-filter">
		<div class="form-group">
				<?php
				echo $form->dropDownList($model,'starttime', CHtml::listData (SegStarttimes::model()->findAll(),/*'idseg_starttimes'*/'timevalue', 'timevalue'),
					array('empty'=>'Uhrzeit','id'=>'picktime'));
			?>
		</div>
		</div>
	<div class="row-filter">
				<?php
				echo $form->dropDownList($model,'language_id', CHtml::listData (Languages::model()->findAll(),'id_languages', 'germanname'),
					array('empty'=>'Sprache','id'=>'picklang'));
			?>
	</div>
	<div class="row-filter">
				<?php
					$gui=new User('search_gn');
					echo $form->dropDownList($model,'guide1_id',CHtml::listData($gui->search_gn(),'id','guidename'),
					array('empty'=>'Guide','id'=>'pickguide'));
			?>
	</div>

	<div class="row-filter">
	         	<button class="but-filter" type="submit"><?php echo 'SUCHE'; ?></button>
   	<?php // echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->