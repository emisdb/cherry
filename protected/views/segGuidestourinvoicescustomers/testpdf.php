<!-- param -->
<? 
	$date_format = strtotime($sched->date);
	$date_format = date('d.m.Y',$date_format);
	
	$time_format = substr_replace($sched->starttime, 0, 4);

?>


<table class="table-pdf1">
	<tr>
		<td>
    		<div class="pdf-h1">Route Accounting</div> 
            <table class="table-pdf2">
            	<tr>
                	<td>Invoice number:</td>
                    <td style="text-align:right;"><? echo $invoice->TA_string;?></td>
                </tr>
                <tr>
                	<td>Date of invoice:</td>
                    <td style="text-align:right;"><? echo $date_format;?></td>
                </tr>
                <tr>
                	<td>Time of day:</td>
                    <td style="text-align:right;"><? echo $time_format;?></td>
                </tr>
                <tr>
                	<td>Tour ID:</td>
                    <td style="text-align:right;"><? echo $sched->tourroute_id;?></td>
                </tr>
                <tr>
                	<td>Page:</td>
                    <td>1 of 2</td>
                </tr>
            </table> 
            <div class="pdf-h2">Tour guests on<span class="pdf-h3"><? echo $date_format;?>, <? echo $time_format;?></span></div>   
        </td>
        <td style="text-align:right;">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/str2/logo2.png" width="174" height="137" alt=""/>
        </td>
	</tr>
</table>
<hr style="border:1px solid #000000;">

<table class="table-pdf1">
  <tbody>
    <tr>
      <th>Tour host number</th>
      <th>Name</th>
      <th>Discount</th>
      <th>Payment</th>
      <th>Price</th>
      <th>Vat.</th>
    </tr>
    <? if(!empty($invoicecustomers)) { ?>
		<? foreach($invoicecustomers as $item) {?>
            <tr>
              <td><? echo $item->KA_string;?></td>
              <td><? echo $item->customersName;?></td>
              <td> <?
				  if($item->discounttype_id==0) {
						echo '--';
				  } else {
						echo $item->discount['val'];?> <? echo $item->discount['type'];
				  }
			  ?></td>
              <td><? 
				  if ($item->paymentoptionid==0) {
						echo '--';
				  } else {
						echo $item->payment['displayname'];
				  }
			  ?></td>
              <td><? echo $item->price;?> &euro;</td>
              <td><? $vat_i = $item->price*$vat/100;
			  echo $vat_i;?>  &euro;
              </td>
            </tr>
         <? } ?>
    <? } ?>
    
  </tbody>
</table>
<hr style="border:1px solid #000000;">
<table >
	<tr>
    	<td style="width:400px">111&nbsp;</td>
        <td style="text-align:left;">Total revenue excluding VAT: </td>
        <td style="text-align:right;"><? echo $invoice->overAllIncome;?> &euro;</td>
    </tr>
    	<tr>
    	<td></td>
        <td style="text-align:left;">Sales tax: </td>
        <td style="text-align:right;"><? echo $sum_vat;?> &euro;</td>
    </tr>
    	<tr>
    	<td></td>
        <td style="text-align:left;">Total revenue: </td>
        <td style="text-align:right;"><? echo $sum_b_vat;?> &euro;</td>
    </tr>
    	<tr>
    	<td></td>
        <td style="text-align:left;">Share of cash income includes tax: </td>
        <td style="text-align:right;"><? echo $invoice->cashIncome;?> &euro;</td>
    </tr>
</table>
