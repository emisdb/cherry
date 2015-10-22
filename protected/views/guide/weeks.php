<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Scheduled Tours',
);

?>

<h1>Scheduled Tours </h1>
                    <div style=" width:100px;">
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'publishDate',
 								'value'=>$date,
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                               'showAnim'=>'fold',
                                'dateFormat' => 'dd.mm.yy',
                                 'yearRange'=>'2015:2050',
                                 'minDate' => 0,//'01.06.2015',//0, 
                                 'defaultDate'=> time(),     
                                 //'maxDate' => '2099-12-31',  
                                 'onSelect'=> 'js: function(date) {if(date != "") { 
                                    window.location.href = "'.CHtml::encode($this->createUrl('guide/weeks'
                                    )).'/date/"+date ;
                                 } }',
                            ),
                            'htmlOptions'=>array(
                                 	'size' => '10',         // textField size
        							'maxlength' => '10', 
                            ),
                            'flat'=>false,
                        )); 
                    ?>
                    </div>

       </section>

        <!-- Main content -->
        <section class="content">


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
        <a href="<?php echo Yii::app()->createUrl('guide/take', array('date'=>$date, 'time'=>$item->time)); ?>">Take</a>
    <?php } else { 
        
        if($item->status=='Block') {?>
            No action
         <?php }else{ ?>
            <a href="<?php echo Yii::app()->createUrl('guide/show', array('id'=>$item->id)); ?>">Show</a>
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
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->