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
	<div class="frontlabel" style="font-size:2em; margin-top:150px;" >TOUREN, DIE MAN NICHT VERGISST</div>
	<div class="frontlabel" style="font-size:1.2em;" >Tauchen Sie ein in Deutschlands gr&ouml;&szlig;te Metropolen</div>
	<div style="width:100%;  text-align: center; margin:30px 0 150px;" >	   <?php       $this->renderPartial('_select_front', array('model'=>$model)) ;?>
</div>

</div>
	<div class="row frontlabel" style="font-size:1.7em; color:#555; margin:30px 0;" >EROBERE DEINE STADT</div>
	<div class="row" style="text-align: center; margin:auto;">
	<div style="text-align: center; margin:20px 30px;">
		<div class="teaser berlin">
		<div style="width:100%;  text-align: center;" >
			<?php	echo	CHtml::image(Yii::app()->request->baseUrl.'/img/icon-museum.png','info',array('style'=>'height: 40px; margin-top:60px; ')); ?>
		</div>
			<div class="frontlabel" >
				CLASSIC BERLIN
			</div>
		</div>
		<div class="teaser munchen">
			<?php	echo	CHtml::image(Yii::app()->request->baseUrl.'/img/icon-castle.png','info',array('style'=>'height: 40px; margin-top:60px;' )); ?>
			<div class="frontlabel" >
				HISTORICAL M&Uuml;NCHEN
			</div>
			
		</div>
		<div class="teaser hamburg">
			<?php	echo	CHtml::image(Yii::app()->request->baseUrl.'/img/icon-food.png','info',array('style'=>'height: 40px; margin-top:60px;')); ?>
			<div class="frontlabel" >
				SPECIAL HAMBURG
			</div>
		</div>
	</div>
	</div>
	



