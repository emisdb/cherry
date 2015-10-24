<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		 <div class="modal modal-primary fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Show tour</h4>
			   </div>
			   <div class="modal-body">
				 <div id="modal-data">This is the guide's info.</div>
			   </div>
			   <div class="modal-footer">
					<button  type="button" class="btn btn-outline pull-right btn-default" data-dismiss="modal">Close</button>
			   </div>
			 </div>
		   </div>
		 </div>
        <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>Scheduled Tours </h1>
			<ol class="breadcrumb">
				<li class="active"> Scheduled Tours
				</li>
			</ol>	
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
    <td><?php if($item->status=='frei!'){
         echo CHtml::link("Take",array('guide/take', 'date'=>$date, 'time'=>$item->time));
     }
	 else {        
        if($item->status=='Block') { echo "No action\n";}
		else{  
        echo CHtml::ajaxLink(
             "Show",
             $url=array('ajaxShow'),
             $ajaxOptions= array(
            'data'=>array('id'=>$item->id),
              'type'=>'POST',
		     'success'=>'function(html){ jQuery("#modal-data").html(html);  $("#guideModal").modal("show");return true;}',
///             'complete' => 'return true;'
				 )	  
//             $htmlOptions=array("data-toggle"=>"modal","data-target"=>"#guideModal" )
     );
		}
	}?>
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