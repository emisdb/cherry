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
		<ul class="teaserhold">
			<li><?php echo CHtml::link('<div class="teaser berlin"><div>'
					.CHtml::image(Yii::app()->request->baseUrl.'/img/icon-museum.png','info')
					.'</div><div class="frontlabel">CLASSIC BERLIN</div></div>',array('/berlin'));	
			?>
			</li>
			<li><?php echo CHtml::link('<div class="teaser munchen"><div>'
					.CHtml::image(Yii::app()->request->baseUrl.'/img/icon-castle.png','info',array('style'=>'height: 40px; margin-top:60px; '))
					.'</div><div class="frontlabel">HISTORICAL M&Uuml;NCHEN</div></div>',array('/munchen'));	
			?>
			</li>
			<li><?php echo CHtml::link('<div class="teaser hamburg"><div>'
					.CHtml::image(Yii::app()->request->baseUrl.'/img/icon-food.png','info',array('style'=>'height: 40px; margin-top:60px; '))
					.'</div><div class="frontlabel">SPECIAL M&Uuml;NCHEN</div></div>',array('/munchen'));	
			?>
			</li>
		</ul>
	</div>
	



