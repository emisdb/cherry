<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 Yii::app()->clientScript->registerScriptFile('http://maps.googleapis.com/maps/api/js',CClientScript::POS_HEAD);
 ?>
<div class="row" id="top" style="position:relative;">
	<?php	
		echo	CHtml::image(Yii::app()->request->baseUrl.'/img/cherrytours_icon_white_rgb.png','info',array('style'=>'height: 50px; position: absolute; top: 5%; left: 48%'));
		echo	CHtml::image(Yii::app()->request->baseUrl.'/img/top.jpg','info',array('style'=>'width: 100%;'));
	?>
	<div style="width:100%; font-size:1.7em; color:#fff; font-weight:bold; letter-spacing: 5px; position: absolute; top: 26%; text-transform: uppercase; text-align: center;" >CHERRYTOURS</div>
	<div style="width:100%; font-size:1.7em; color:#fff; font-weight:bold; letter-spacing: 5px; position: absolute; top: 38%; text-transform: uppercase; text-align: center; " ><?php echo $model->city_ob->seg_cityname ?></div>
	<?php
/*	echo "Date".date('Y-m-d',strtotime($model->date));  
	echo "from: ".$model->from_date ;
	echo "to: ".$model->to_date ;
	echo "start: ".is_null($model->starttime) ? "NULL" : "NOT".":".date('H:i:s',time()) ;
	echo "city: ".$model->city_id ;
 */

//		var_dump(CHtml::listData($gui->search_gn(),'id','guidename'));
		?>
</div>

<div class="row">
	<div class="col-md-3" style="padding: 0;">
 <ul class="nav nav-pills nav-justified hidden-sm hidden-xs">
    <li><a href="#" class="nohover"><div style="min-height: 50px;"></div></a></li>
  </ul>
	<div id="googleMap" style="width:100%;height:210px; margin-bottom: 5px;"></div>
   <?php       $this->renderPartial('_select', array('model'=>$model)) ;?>
	</div>
	<div class="col-md-9" style="padding: 0;">
<?php
	$data = $tours->search()->getData();
?>	

	<ul class="nav nav-pills">
	<?php
		$ii=0;
		foreach($data as $value)
		{
			$img;
			if ($value['id_tour_categories']==1) $img=CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_classic.svg','classic',array('style'=>'height: 50px; width:50px;'));
			elseif ($value['id_tour_categories']==2) $img=CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_historical.svg','historical',array('style'=>'height: 50px; width:50px;'));
			elseif ($value['id_tour_categories']==3)
			{
				if ($value['cityid']==2)
					$img=CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_special_munich.svg','special',array('style'=>'height: 50px; width:50px;'));
				else 
					$img=CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_special.svg','special',array('style'=>'height: 50px; width:50px;'));
			}
			$str='<li '.(($ii==0) ? 'class="active"' : '').'><a data-toggle="tab" href="#tab'.$ii.'">'
					.$img
					.$value['name'].'</a></li>';
			echo $str;
			$ii++;
		}
	?>
	</ul>
	<div class="tab-content">
	
	<?php
		$ii=0;
		foreach($data as $value)
		{
			echo	'<div id="tab'.$ii.'" class="tab-pane fade '.(($ii==0) ? 'in active' : '').'">';
			echo	'<div class="panel panel-default">';
			echo	'<div class="panel-heading">'
						.'<div class="row">'
							.'<div class="col-md-9">';
						echo	'<div class="row">'
									.'<div class="col-md-1">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_info.svg','info',array('style'=>'height: 50px; width:50px;')).
									'</div>'
									.'<div class="col-md-11">'.$value['shorttext'].
									'</div>'
								.'</div>';
							echo '<div class="row" style="font-size:.8em; margin-top:5px;">'
									.'<div class="col-md-11 col-md-offset-1">'.$value['maintext'].'</div>'
								.'</div>'
							.'</div>';
			echo	'<div class="col-md-3">';
			echo	'<div class="row">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_duration.svg','duration',array('style'=>'height: 50px; width:50px;')).
					$value['standard_duration'].' min</div>';
			echo	'<div class="row">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_euro.svg','euro',array('style'=>'height: 50px; width:50px;')).
					number_format($value['base_price'], 2, '.', ' ').' inkl. Mvst.</div>';
			echo	'<div class="row">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_pin.svg','pin',array('style'=>'height: 50px; width:50px;')).
					$value['route_pic'].' </div>';
			echo '</div></div></div>';
			echo	'<div class="panel-body">';
				$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$model->search_f($value['id_tour_categories']),
				'itemView'=>'_view',
			));
			echo '</div></div></div>';
			$ii++;
		}
	?>	
	</div>
	</div>
</div>
<script>
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(52.518343, 13.342357),
    zoom:13,
    disableDefaultUI:true,    
	mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>	



