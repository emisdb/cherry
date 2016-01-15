<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 Yii::app()->clientScript->registerScriptFile('http://maps.googleapis.com/maps/api/js',CClientScript::POS_HEAD);
 ?>
<div class="row" id="top">
	<?php	
//		echo	CHtml::image(Yii::app()->request->baseUrl.'/img/top.jpg','info',array('style'=>'width: 100%;'));
	?>
	<div style="width:100%;  text-align: center;" ><?php	echo	CHtml::image(Yii::app()->request->baseUrl.'/img/cherrytours_icon_white_rgb.png','info',array('style'=>'height: 40px; ')); ?></div>
	<div style="width:100%; font-size:1.4em; color:#fff; font-weight:bold; letter-spacing: 5px; text-transform: uppercase; text-align: center;" >CHERRYTOURS</div>
	<div style="width:100%; font-size:1.1em; color:#fff; font-weight:bold; letter-spacing: 5px;  text-transform: uppercase; text-align: center; margin-bottom:130px;" ><?php echo $model->city_ob->seg_cityname ?></div>

</div>
	<?php
/*	echo "Date".date('Y-m-d',strtotime($model->date));  
	echo "from: ".$model->from_date ;
	echo "to: ".$model->to_date ;
	echo "start: ".is_null($model->starttime) ? "NULL" : "NOT".":".date('H:i:s',time()) ;
	echo "city: ".$model->city_id ;
 */
//var_dump($model);
//		var_dump(CHtml::listData($gui->search_gn(),'id','guidename'));
		?>
<div class="row">
	<div class="col-md-3" style="padding: 0;">
		<ul class="nav nav-pills nav-justified hidden-sm hidden-xs">
			<li><a href="#" class="nohover"><div style="min-height: 65px;"></div></a></li>
		</ul>
		<div id="googleMap" style="width:100%;height:210px; margin-bottom: 5px;"></div>
		<div style=" text-align: right;">
			<?php       $this->renderPartial('_select', array('model'=>$model)) ;?>
		</div>
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
			if ($value['id_tour_categories']==1) $img=CHtml::image(Yii::app()->request->baseUrl.'/img/icon-museum.png','classic',array('style'=>'height: 45px;'));
			elseif ($value['id_tour_categories']==2) $img=CHtml::image(Yii::app()->request->baseUrl.'/img/icon-castle.png','historical',array('style'=>'height: 45px;'));
			elseif ($value['id_tour_categories']==3)
			{
				if ($value['cityid']==2)
					$img=CHtml::image(Yii::app()->request->baseUrl.'/img/beer.png','special',array('style'=>'height: 45px;'));
				else 
					$img=CHtml::image(Yii::app()->request->baseUrl.'/img/icon-food.png','special',array('style'=>'height: 45px;'));
			}
			$str='<li '.(($ii==0) ? 'class="active"' : '').'><a data-toggle="tab" href="#tab'.$ii.'">'
					.$img
					.'<div>'.$value['name'].'</div></a></li>';
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
							.'<div class="col-md-9 bordered">';
						echo	'<div class="row">'
									.'<div class="col-md-1">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/info.png','info',array('style'=>'height:30px;')).
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
					CHtml::image(Yii::app()->request->baseUrl.'/img/hourglass.png','duration',array('style'=>'margin-right:15px;')).
					$value['standard_duration'].' min</div>';
			echo	'<div class="row">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/euro.png','euro').
					number_format($value['base_price'], 2, '.', ' ').' inkl. Mvst.</div>';
			echo	'<div class="row">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/location.png','pin').
					$value['route_pic'].' </div>';
			echo '</div></div></div>';
			echo	'<div class="panel-body">';
			$dp=$model->search_f($value['id_tour_categories']);
//			var_dump($dp->getData());
			 $this->renderPartial('_loop', array('dataProvider'=>$dp,
								'tid'=>$value['id_tour_categories'],
								'tnmax'=>$value['TNmax']));
			echo '<div id="req_res_loading'.$ii.'"></div>';
		echo '</div>';
		echo '<div class="panel-footer">';
		echo $dp->totalItemCount.' > '.$dp->pagination->pageSize.'>'.$dp->itemCount;
		 if ($dp->totalItemCount  > $dp->pagination->pageSize){
			 echo '<div class="row" style="margin: 10px 0; padding:10px;">
                            <div class="span9" style="text-align:center;">
                                <p id="loading_classic'.$ii.'" style="display:none">';
			 echo CHtml::image(Yii::app()->request->baseUrl.'/img/loader.gif','loading');
					 echo '</p></div></div>';
			 echo '<div id="showbutton'.$ii.'" class="row" style="position:relative;top:0;width:197px;margin:0 auto;">';
    echo CHtml::ajaxButton(
    'MEHR ANZEIGEN',          // the link body (it will NOT be HTML-encoded.)
    array('ajaxLoad'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
    array(
//        'data'=>array('arrdata'=>'js:$("#yw0").serialize();'),
        'data'=>array('arrdata'=> json_encode($model->attributes),
											'type'=>$value['id_tour_categories'],
											'tnmax'=>$value['TNmax'],
											'page'=>'js:pageN['.$ii.']',
					),
        'type'=>'POST',
//       'update'=>'#req_res_loading'.$ii,
        'beforeSend' => 'function() {           
           $("#loading_classic'.$ii.'").show();
       }',
        'success' => 'function(data) {
          $("#loading_classic'.$ii.'").hide();
			$("#req_res_loading'.$ii.'").append(data);
 			 pageN['.$ii.']++;
			 if(pageN['.$ii.']*'.$dp->pagination->pageSize.'>='.$dp->totalItemCount.')
		      $("#showbutton'.$ii.'").hide();
        }',        
			 ),
			array('class'=>'btn btn-default')
		);
             echo '</div>';
		 }
  		echo '</div>';
		echo '</div></div>';
			$ii++;
		}
	?>	
	</div>
	</div>
</div>
<script type="text/javascript">
	  var pageN=[<?php for($vi=0;$vi<$ii;$vi++) echo "1,"; ?>];
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



