<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Scheduled Tours',
);

?>

<h1>Scheduled Tours </h1>
<?php echo $date;?>

<table class='table' >
<tr>
<td>TIME original</td>
<td>TIME start</td>
<td>STATUS</td>
<td>ACTION</td>
</tr>
<?php foreach($model as $item){?>
    <tr>
    <td><?php echo $item->time;?></td>
    <td><?php echo $item->starttime;?></td>
    <td><?php echo $item->status;?></td>
    <td><?php if($item->status=='frei!'){?>
        <a href="<?php echo Yii::app()->createUrl('segScheduledTours/take', array('date'=>$date, 'time'=>$item->time)); ?>">Take</a>
    <?php } else { 
        
        if($item->status=='Block') {?>
            No action
         <?php }else{ ?>
            <a href="<?php echo Yii::app()->createUrl('segScheduledTours/show', array('id'=>$item->id)); ?>">Show</a>
         <?php }?>
    <?php }?>
    </td>
   
    
    </tr>
<?php }?>
</table>
<!--
<php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',0
	'dataProvider'=>$model,
//	'filter'=>$model,
	'columns'=>array(
        /*array(
            'name'=>'role_ob',
            'value'=>'$data->role_ob->groupname',
            'filter'=>CHtml::listData($usergroups, 'idusergroups', 'groupname'),
        ),*/
		'username',
		'profile',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{action}',
            'buttons' => array(
               'action' => array(
                     //'imageUrl'=>'/images/system/proc.png',
                    'url' => 'Yii::app()->createUrl("/user/update/id/$data->id")',
                    //'label'=>'Update',
               ),
              
            ),
		),
	),
)); ?>
-->