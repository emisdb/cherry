<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
 		 <div class="modal modal-info fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Cashbox History</h4>
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
			<?php
$this->breadcrumbs=array(
	'History cashbox',
);
?>

<h1>History cashbox</h1>
      </section>

        <!-- Main content -->
        <section class="content">


<table class="table-history-cashbox">
 	<tr>
    	<th>Date</th>
    	<th>Type</th>
        <th>Before</th>
        <th>Cash</th>
        <th>Result</th>
        <th>Action</th>
    </tr>
    
	<? foreach($history as $item){?>
    <tr>
    	<td><? echo $item->timestamp;?></td>
     	<td><? echo $item->typename;?></td>
        <td><? echo $item->cashBefore;?>  &euro;</td>
        <td><? echo $item->delta_cash;?>  &euro;</td>
        <td><? echo $item->delta_cash+$item->cashBefore;?>  &euro;</td>
        <td>
			<?php        echo CHtml::ajaxLink(
             "Details",
             $url=array('ajaxHistory'),
             $ajaxOptions= array(
            'data'=>array('id'=>$item->idcashbox_history),
              'type'=>'POST',
		     'success'=>'function(html){ jQuery("#modal-data").html(html);  $("#guideModal").modal("show");return true;}',
///             'complete' => 'return true;'
				 )	  
//             $htmlOptions=array("data-toggle"=>"modal","data-target"=>"#guideModal" )
     );?>
		</td>
    </tr>
    
    <? } ?>
</table>
	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


