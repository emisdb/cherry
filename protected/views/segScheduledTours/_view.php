<?php
/* @var $this SegScheduledToursController */
/* @var $data SegScheduledTours */
?>

<div class="row" >
	<div class="col-md-3 col-sm-5 bordered">
      <?php 
			$first_cell=CHtml::image(Yii::app()->request->baseUrl."/image/guide/".$data->user_ob->guidepic, "User Image", array("class"=>"img-circle")).
			   "<div><div>".CHtml::encode($data->user_ob->guidename)."</div><div>";
				if($data->language_id==null) {
					foreach ($data->user_ob->languages as $value) {
						 $first_cell.=CHtml::image(Yii::app()->request->baseUrl."/img/lan/".$value['flagpic'], "Language", array("class"=>"img-circle")) ; 
					}
				}
				else {
					 $first_cell.=CHtml::image(Yii::app()->request->baseUrl."/img/lan/".$data->language_ob->flagpic, "Language", array("class"=>"img-circle")) ; 
				}
				$first_cell.="</div></div>";
				echo CHtml::ajaxLink(
             $first_cell,
             $url=array('ajaxGuide'),
             $ajaxOptions= array(
            'data'=>array('id'=>'js:$(this).attr("href")'),
             'type'=>'POST',
//             'update'=>'#modal-data',
            'dataType'=>'json',
		 'success' => "function(data) { 
				 if (data.status == 'failure')
                {
                    $('#modal-data').html(data.div);
                 }
                else
                {
                   $('#modal-title').html(data.status);
                   $('#modal-data').html(data.div);
                }

				 $('#guideModal').modal();  }"),
	 
             $htmlOptions=array('href'=>'gid='.$data->user_ob->id.';',
				 "class"=>"guideclick", "data-toggle"=>"modal", "data-target"=>"#guideModal"
                 )
			 );
//				echo CHtml::link($first_cell, 'js:gid='.$data->user_ob->id.';', array("class"=>"guideclick", "data-toggle"=>"modal", "data-target"=>"#guideModal"));
		?>
	</div>
	<div class="col-md-4 cl-sm-7 bordered">
       	<?php
		echo CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_calendar.svg','calendar',array('style'=>'height: 40px;'));
		echo CHtml::encode(date('l, d F Y',$data->date_now));
		?>
		<div>
       	<?php
		echo CHtml::image(Yii::app()->request->baseUrl.'/img/svg/svg-export_time.svg','time',array('style'=>'height: 40px;'));
		echo CHtml::encode(substr_replace($data->starttime, '', 5));
		?>
			
		</div>
   	</div>
 	<div class="col-md-3 col-sm-8 bordered" style="padding:6px 5px;">
		<?php 
		if($tnmax>0)
		{
			$iibreak=round($tnmax/2);
			echo '<div class="manline">'; 
			for($ii=0;$ii<$tnmax;$ii++){
			if($ii==$iibreak) echo '</div><div class="manline">';
			if($ii<$data->current_subscribers)
				 echo CHtml::image(Yii::app()->request->baseUrl."/img/man_y.png", "yes man") ; 
			else
				 echo CHtml::image(Yii::app()->request->baseUrl."/img/man_n.png", "no man") ; 
		}
		if($ii>6) echo "</div>";
		$rest=$tnmax;
			if($data->current_subscribers>0) $rest=$tnmax-$data->current_subscribers;
			echo '<div style="margin-top:4px;text-align: center;width:100%">'.$rest." freie Pl&auml;tze</div>"; 
			}	
		?>
	</div>
	<div class="col-md-2 col-sm-4" style="padding: 23px;">
		<button class="btn btn-success" style="color:#fff;" onclick="submitdata(<?php echo $data->idseg_scheduled_tours.",".$tid ?>)">AUSW&Auml;LEN</button>
	</div>
	<?php /*
		<button class="btn btn-success"><?php echo CHtml::link("AUSW&Auml;LEN", '#',array('style'=>'color:#fff;','onclick'=>'submitdata('.$data->idseg_scheduled_tours.','.$tid.');',)) ?></button>

	 		<button class="btn btn-success"><?php echo CHtml::link("AUSW&Auml;LEN", array('book','id'=>$data->idseg_scheduled_tours,'cat'=>$tid),array('style'=>'color:#fff;')) ?></button>

	 	<div class="col-md-1">
	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_scheduled_tours')); ?>:</b>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tourroute_id')); ?>:</b>
	<?php echo CHtml::encode($data->tourroute_id); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('openTour')); ?>:</b>
	<?php echo CHtml::encode($data->openTour); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TNmax_sched')); ?>:</b>
	<?php echo CHtml::encode($data->TNmax_sched); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('starttime')); ?>:</b>
	<?php echo CHtml::encode($data->starttime); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_subscribers')); ?>:</b>
	<?php echo CHtml::encode($data->current_subscribers); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	<?php echo CHtml::encode($data->language_id); ?>
	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide1_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide1_id); ?>
	</div>
	<div class="col-md-1">
	<b><?php echo CHtml::encode($data->getAttributeLabel('original_starttime')); ?>:</b>
	<?php echo CHtml::encode($data->original_starttime); ?>

	</div>
	<div class="col-md-1">

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city_id); ?>

	</div>


	<b><?php echo CHtml::encode($data->getAttributeLabel('guide2_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide2_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide3_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide3_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide4_id')); ?>:</b>
	<?php echo CHtml::encode($data->guide4_id); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_info')); ?>:</b>
	<?php echo CHtml::encode($data->additional_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visibility')); ?>:</b>
	<?php echo CHtml::encode($data->visibility); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide1')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide2')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide3')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isInvoiced_guide4')); ?>:</b>
	<?php echo CHtml::encode($data->isInvoiced_guide4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('additional_info2')); ?>:</b>
	<?php echo CHtml::encode($data->additional_info2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isCanceled')); ?>:</b>
	<?php echo CHtml::encode($data->isCanceled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancellationReason')); ?>:</b>
	<?php echo CHtml::encode($data->cancellationReason); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('canceledBy')); ?>:</b>
	<?php echo CHtml::encode($data->canceledBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cancellationAnnotation')); ?>:</b>
	<?php echo CHtml::encode($data->cancellationAnnotation); ?>
	<br />

	*/ ?>

</div>