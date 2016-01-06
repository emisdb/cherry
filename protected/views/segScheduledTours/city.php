<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */
 ?>
<div class="row">
	<?php echo "Date".date('Y-m-d',strtotime($model->date)); ?>
	<?php  
	echo "from: ".$model->from_date ;
	echo "to: ".$model->to_date ;
	echo "start: ".is_null($model->starttime) ? "NULL" : "NOT".":".date('H:i:s',time()) ;
	echo "city: ".$model->city_id ;
//		var_dump(CHtml::listData($gui->search_gn(),'id','guidename'));
		?>
</div>

<div class="row">
	<div class="col-md-3">
    <?php       $this->renderPartial('_select', array('model'=>$model)) ;?>
	</div>
	<div class="col-md-9">
<?php
	$data = $tours->search()->getData();
?>	

	<ul class="nav nav-pills">
	<?php
		$ii=0;
		foreach($data as $value)
		{
			$str='<li '.(($ii==0) ? 'class="active"' : '').'><a data-toggle="tab" href="#tab'.$ii.'">'.$value['name'].'</a></li>';
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
			echo	'<div class="panel-heading"><div class="row"><div class="col-md-9">'.$value['maintext'].'</div>';
			echo	'<div class="col-md-3">';
			echo	'<div class="row">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_duration.svg','duration',array('style'=>'height: 50px; width:50px;')).
					$value['standard_duration'].' min</div>';
			echo	'<div class="row">'.
					CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_euro.svg','duration',array('style'=>'height: 50px; width:50px;')).
					number_format($value['base_price'], 2, '.', ' ').' inkl. Mvst.</div>';
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
	



