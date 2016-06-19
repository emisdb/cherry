<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Show Tour',
);

?>
<?php  $date_format =  date('d.m.Y',$model->date_now);?>


<h1>Show Tour - <?php echo $model->starttime;?> - <?php echo $date_format;?> - <?php echo $model->city_id_all;?></h1>

<table class="table">
<tr>
<td>Id tours</td>
<td><?php echo $model->idseg_scheduled_tours;?></td>
</tr>
<tr>
<td>Guests maximum</td>
<td><?php echo $model->TNmax_sched;?></td>
</tr>
<tr>
<td>Currently being booked guests</td>
<td><?php echo $model->current_subscribers;?></td>
</tr>
<tr>
<td>Start Time</td>
<td><?php echo $model->starttime;?></td>
</tr>
<tr>
<td>Touring</td>
<td><?php echo $model->duration;?></td><!-- время туров-->
</tr>
<tr>
<td>Route</td><!-- маргруты-->
<td>
<?php if(!isset($model->tourroute_ob->name)){?>
<?php foreach($model->tourroute_id_all as $item_route){?>
    <?php echo $item_route;?>
<?php }?>
<?php }else{?>
<?php echo $model->tourroute_ob->name;?>
<?php }?>

</td>
</tr>
<tr>
<td>Language</td><!-- языки-->
<td>
<?php if(!isset($model->language_ob->flagpic)){?>
<?php $lan_count = count($model->language_id_all);?>
<?php for($i=0;$i<$lan_count;$i++){ ?>
    <?php foreach($model->language_id_all[$i] as $item_language){?>
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/lan/<?php echo $item_language->flagpic;?>" />
    <?php }?>
<?php }?>
<?php }else{?>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/lan/<?php echo $model->language_ob->flagpic;?>" />
<?php }?>

</td>
</tr>
<tr>
<td>Comments</td>
<td><?php echo $model->additional_info;?></td>
</tr>
<tr>
<td>Visible on the website</td>
<td><?php echo $model->visibility;?></td>
</tr>



</table>



<!--<button class="btn btn-primary cancel" > <a href="<php echo Yii::app()->createUrl('segScheduledTours/weeks', array('date'=>$date_format));?>">Back</a></button>-->
<a href="<?php echo Yii::app()->request->baseUrl; ?>/segScheduledTours/weeks/date/<?php echo $date_format;?>"><button class="btn btn-primary cancel" > Back</button></a>
 
  