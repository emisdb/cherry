<?php
$this->breadcrumbs=array(
	'Cashbox History',
);
?>

<h1>Cashbox History details</h1>

<table class="table-history-cashbox">
 	<tr>
    	<th>Before</th>
        <td><? echo $item->cashBefore;?>  &euro;</td>
    </tr>
 	<tr>
    	<th>Cash</th>
        <td><? echo $item->delta_cash;?>  &euro;</td>
    </tr>            
 	<tr>
    	<th>Result</th>
        <td><? echo $item->delta_cash+$item->cashBefore;?>  &euro;</td>
    </tr>            
 	<tr>
    	<th style="vartical-align:middle;">Comment</th>
        <td>

        
        
        	<div>Type: <? echo $item->typename;?></div>
        	<div>Guide: <? echo $guide_name;?></div>
        	<div>TourID: <? echo $tour_id;?></div>
        	<div>TA: <? echo $invoice_name;?></div>
        
        </td>
    </tr>            
 	<tr>
    	<th>Edited by</th>
        <td><? echo $guide_id;?></td>
    </tr>
 	<tr>
    	<th>Approved by</th>
        <td></td>
    </tr>
  	<tr>
    	<th>Date</th>
        <td><? echo $item->timestamp;?></td>
    </tr>   
 	<tr>
    	<th>ID cashbox_history</th>
        <td><? echo $item->idcashbox_history;?></td>
    </tr>    
    
    
     
  
</table>