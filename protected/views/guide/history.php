<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
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
        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/cashboxHistory/view/id/<? echo $item->idcashbox_history;?>">Details</a></td>
    </tr>
    
    <? } ?>
</table>
	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


