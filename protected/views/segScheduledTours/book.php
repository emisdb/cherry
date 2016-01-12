<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 ?>
<div class="row top-menus">
	<div class="col-md-1">
		<?php echo CHtml::link("< zur&uuml;ck", array("city",'city'=>$model->city_id) ); ?>
	</div>
	<div class="col-md-10">
		<div class="title">
		TOUR BUCHEN
		</div>
	</div>
	<div class="col-md-1">
	</div>
</div>
<div class="row" id="top_start">
	<?php	
//		echo	CHtml::image(Yii::app()->request->baseUrl.'/img/top.jpg','info',array('style'=>'width: 100%;'));
	?>
	<!--<div class="gradient"><div>-->
	<div style="width:100%;  text-align: center;" ><?php	echo	CHtml::image(Yii::app()->request->baseUrl.'/img/cherrytours_icon_white_rgb.png','info',array('style'=>'height: 50px; ')); ?></div>
	<div class="frontlabel" >CHERRYTOURS</div>
	<div class="frontform">
	   <?php       $this->renderPartial('_select_book', array(
													   'model'=>$model,
														'tour'=>$tour,));
	   ?>
	</div>

</div>

	



