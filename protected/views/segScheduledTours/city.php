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
	foreach($data as $value)
	{
		echo	'<div class="panel panel-primary">';
  		echo	'<div class="panel-heading">'.$value['name'].'</div>';
  		echo	'<div class="panel-body">'.$value['maintext']."<p>";
			$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$model->search_f($value['id_tour_categories']),
			'itemView'=>'_view',
		));
		echo '</div></div>';
 	}

?>		
	</div>
</div>
	



