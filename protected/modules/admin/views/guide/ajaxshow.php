<?php  $date_format =  date('d.m.Y',$model->date_now);?>


<h1><?php echo Yii::app()->dateFormatter->format('HH:mm',strtotime($model->starttime));?> - <?php echo $date_format;?> - <?php echo $model->city_id_all;?></h1>
 
<table class="table">
<tr>
<td>Id tours</td>
<td><?php echo $model->idseg_scheduled_tours;?></td>
</tr>
<tr>
    <td>Die G&auml;ste maximal</td>
<td><?php echo $model->TNmax_sched;?></td>
</tr>
<tr>
    <td>Zur Zeit gebucht werden G&auml;ste</td>
<td><?php echo $model->current_subscribers;?></td>
</tr>
<tr>
    <td>Guide Name</td>
    <td><?php echo $model->user_ob->guidename;?></td>
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
</table>
 