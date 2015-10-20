<?php
$this->breadcrumbs=array(
	'History cashbox',
);
?>

<h1>History cashbox</h1>

<table class="table-history-cashbox">
 	<tr>
    	<th>Date</th>
        <th>Before</th>
        <th>Cash</th>
        <th>Result</th>
        <th>Action</th>
    </tr>
    
	<? foreach($history as $item){?>
    <tr>
    	<td><? echo $item->timestamp;?></td>
        <td><? echo $item->cashBefore;?>  &euro;</td>
        <td><? echo $item->delta_cash;?>  &euro;</td>
        <td><? echo $item->delta_cash+$item->cashBefore;?>  &euro;</td>
        <td><a href="<?php echo Yii::app()->request->baseUrl; ?>/cashboxHistory/view/id/<? echo $item->idcashbox_history;?>">Details</a></td>
    </tr>
    
    <? } ?>
</table>


