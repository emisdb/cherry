<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 ?>
<div class="row" id="top_start">
	<?php	
//		echo	CHtml::image(Yii::app()->request->baseUrl.'/img/top.jpg','info',array('style'=>'width: 100%;'));
	?>
	<!--<div class="gradient"><div>-->
	<div style="width:100%;  text-align: center;" ><?php	echo	CHtml::image(Yii::app()->request->baseUrl.'/img/cherrytours_icon_white_rgb.png','info',array('style'=>'height: 50px; ')); ?></div>
	<div class="frontlabel" >CHERRYTOURS</div>
	<div style="width:100%;  text-align: center; margin:30px 0 150px;" >
	   <?php       $this->renderPartial('_select_front', array('model'=>$model)) ;?>
	</div>

</div>

	



