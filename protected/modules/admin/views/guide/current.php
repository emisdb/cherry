<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<!-- Modal -->
		 <div class="modal modal-info fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Guide info</h4>
			   </div>
			   <div class="modal-body">
				 <div id="modal-data">This is the guide's info.</div>
			   </div>
			   <div class="modal-footer">
					<button  type="button" class="btn btn-outline pull-right btn-default" data-dismiss="modal">Schließen</button>
			   </div>
			 </div>
		   </div>
		 </div>
		 <div class="modal modal-success fade" id="cardModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Credit card payment: <span id="card-title-data"></span>&euro;</h4>
			   </div>
			   <div class="modal-body">
                               <div id="card-modal-data">
                                  <div class="overlay">
                                    <i class="fa fa-refresh fa-spin"></i>
                                    Card loading
                                    </div>
                              </div>
			   </div>
			   <div class="modal-footer">
				<button  type="button" class="btn btn-outline pull-right btn-default" data-dismiss="modal">
                                    Schließen
                                </button>
			   </div>
			 </div>
		   </div>
		 </div>

       <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>Rechnung</h1>
			<ol class="breadcrumb">
				<li>
					<?php echo Chtml::link('Tourplan',array('schedule')); ?>
				</li>
				<li class="active"> 
                                    Rechnung
				</li>
			</ol>	
                        <div id="some-data">
                            
                        </div>
			<button id="changebt" type="button" class="btn btn-primary cancel" data-toggle="modal" data-target="#guideModal">Guide Info</button>

		</section>

        <!-- Main content -->
        <section class="content">
            <div class="alert alert-success fade in" id="paysuccess" style="display: none;">
               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> <?php echo "".$jcode['message']; ?>
            </div>		
            <div class="alert alert-danger fade in" id="payerror" style="display: none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Error!</strong> <?php echo "".$jcode["message"]; ?>
            </div>		
            <!-- param -->
			<div class="row">
			<div class="col-md-8">
			<div class="row create">
			<div class="col-md-4 create-left">

				<?php
				$i=0; 
				 echo $sched->tourroute_ob['name']." "
                                    .$sched['date']." "
                                    .Yii::app()->dateFormatter->format('HH:mm',strtotime($sched['starttime']));
				 $element = 0; $k=0;$i=1;
				 ?>
			</div>
			<div class="col-md-4">
				<?php // echo CHtml::link("New tourist","javascript:void(0);",array('onclick'=>'newtourist();')); ?>
				<?php echo CHtml::link("neue Touristen",array('booky','id_sched'=>$id_sched)); ?>
			</div>	
		<div class="col-md-4">
		</div>
		</div>
		<div class="row">
		<div class="col-md-8">

		<div class="form">
	
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'current-subscriber-form',
			'enableAjaxValidation'=>false,
		)); 
	
		?>
		<input type="hidden" name="pdf" id="pdf" value="0">

		<table border='1' cellpadding="5" cellspacing="5">
			<tr>
				<th>Tourist</th>
				<th>Nr</th>
				<th>Name</th>
				<th>Rabatt/Gutschein</th>
				<th>Zahlungsmittel</th>
				<th style="padding:1px 4px;">Base</th>
				<th style="padding:1px 4px;">Preis</th>
				<th style="padding:1px 4px;">Ust</th>
				<th>Options</th>
			</tr>
			<?php 
			$count_cust=0;
			$strforjs="var custs=[";
			if(count($sched->guidestourinvoices)>0)
			{ 
				foreach($dis as $d)
				{
					$d->nametype = $d->name.' '.$d->type;
				} 
				$list_discount = CHtml::listData($dis, 'id', 'nametype'); 
				$list_pay = CHtml::listData($pay, 'idpayoptions', 'displayname'); 
				$list_op = CHtml::listData($invoiceoptions_array, 'id', 'name'); 
				$count_cust=0;
				foreach ($sched->guidestourinvoices as $value) {
					$model=$value->guidestourinvoicescustomers;
					$i=0;				
					for($element=0;$element < count($model);$element++)
					{
						$count_cust++;
						$i++;
						echo "<tr><td>";
						echo $model[$element]->tourinvoice->contact->idcontacts;
						echo "</td><td>\n";
						$gs = $i;
						$id=$model[$element]->idseg_guidesTourInvoicesCustomers;
						$strforjs.=$id.",";
						echo $gs;
						echo "</td><td>\n";
						if($model[$element]->customersName == '') $model[$element]->customersName = $model[$element]->tourinvoice->contact->firstname.' '. $model[$element]->tourinvoice->contact->surname;
						echo $form->textField($model[$element],'customersName',array('style'=>'width:170px','name'=>'customersName'.$id)); 
						echo "</td><td>\n";
						echo $form->dropDownList($model[$element],'discounttype_id',$list_discount,array('empty' => '--','name'=>'discounttype_id'.$id, 'onChange'=>'discount(value,this.id)'));
						echo "</td><td>\n";
						echo $form->dropDownList($model[$element],'paymentoptionid',$list_pay,array('empty' => '--','name'=>'payoption'.$id, 'onChange'=>'cash(value,this.id)'));
						echo "</td><td style='text-align: right;'>\n";
						$bp = $model[$element]->tourinvoice->sched->tourroute_ob['base_price'];
						$price_sh=0;
						if ($model[$element]->price==null)
							{
								$price_sh=$bp;
							}
						else {
							$price_sh=$model[$element]->price;
						} 
						echo '<div id="base_price'.$id.'" style="float:left;">'.$bp.'</div><div style="float:left;"> &euro;</div><div style="clear:both;"></div>';
						echo "</td><td style='text-align:right;'>\n";
						echo '<div id="price'.$id.'" style="float:left;">'.$price_sh;
						echo '</div><div style="float:left;"> &euro;</div>';
						echo '<div style="clear:both;"></div>';
						echo $form->hiddenField($model[$element],'price',array('name'=>'price'.$id,'id'=>'price_i'.$id)); 
//						echo '<input type="hidden" id="price_i'.$id.'" name="price'.$id.'" value="'.$price_sh.'" >';
						echo '</td><td style="width:40px;text-align:right;">';
						if($model[$element]->price==null){
									$vat_value = $bp*(1-1/($vat_nds/100+1));
								} else {
									$vat_value = $model[$element]->price*(1-1/($vat_nds/100+1));
								}
								$vat_value = number_format($vat_value, 2, '.', ' ');
						echo '<div id="vat'.$id.'" style="float:left;">'.$vat_value.'</div><div style="float:left;"> &euro;</div>';
						echo '<div style="clear:both;"></div>';
						echo "</td><td style='padding:2px 3px;'>\n";
						echo $form->dropDownList($model[$element],'id_invoiceoptions',$list_op,array('empty' => '--','name'=>'option'.$id));
                                                if((int)($model[$element]->creditcard_id)>0)
                                                    $options=array('name'=>'creditcard'.$id,'checked'=>'checked','onchange'=>'counttotals()' );
                                                        else
					         $options=array('name'=>'creditcard'.$id,'onchange'=>'counttotals()' );
						echo $form->checkBox($model[$element],'creditcard_id',$options);
						echo "</td></tr>\n";
						$k++;
					}
				}
				}else{ 
					echo '<tr><td colspan="8">no current</td></tr>';
				}
				?>
		</table>
		</div>
		</div>
		<div class="col-md-4">
		</div>
		</div>
			</div>
		<div class="col-md-4">
		</div>
		</div>

		<div style="display:none;" id="namek"><? echo $k;?></div>
		<div style="display:none;" id="count"><?php echo $count_cust;?></div>
		<div style="display:none;" id="vat_nds"><?php echo $vat_nds;?></div>


		<div style="font-size:14px;font-weight:bold;padding:20px 0;">

			<div style="float:left;width:250px;">Gesamteinnahmen exklusive  USt: </div><div style="float:left;width:100px;" id="price_sv"></div>
			<div style="float:left;"> &euro;</div>
			<div style="clear:both;"></div>
			<hr>

			<div style="float:left;width:250px;">Umsatzsteuer:</div><div style="float:left;width:100px;" id="price_v"></div>
			<div style="float:left;"> &euro;</div>
			<div style="clear:both;"></div>
			<hr>

			<div style="float:left;width:250px;">Gesamteinnahmen: </div><div style="float:left;width:100px;" id="price_s"></div>
			<div style="float:left;"> &euro;</div>
			<div style="clear:both;"></div>
			<hr>

			<div style="float:left;width:250px;">Anteil der Bareinnahmen inkl. Ust: </div><div style="float:left;width:100px;" id="price_cash"></div>
			<div style="float:left;"> &euro;</div>
			 <div style="clear:both;"></div>
			 <hr>

                         <div style="float:left;width:250px;">Credit card payment: </div><div style="float:left;width:100px;" id="price_card"></div>
			<div style="float:left;"> &euro;</div>
			<div style="float:left; margin-left: 15px;"> 
                            <button id="creditcard" type="button" class="btn btn-success cancel" data-toggle="modal" data-target="#cardModal">Pay by card</button>
                        </div>
			 <div style="clear:both;"></div>
			 <hr>
		</div>     

		<!-- *********************** BUTTINS ***************************************************************-->
		<div class="row buttons">
				<button class="btn btn-primary" type="submit"><?php echo 'Speichern'; ?></button>
				<button class="btn btn-primary cancel">
					<?php 
					echo CHtml::link("PDF","javascript:void(0);",array('onclick'=>'newtourist();'));
					?>
				</button>
				<button class="btn btn-primary cancel"><?php echo CHtml::link("Abbrechen", array("schedule")) ?></button>
		</div>

		<?php
		$this->endWidget();
		?>

</div><!-- form -->
	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



<!-- *********************** javascript ***************************************************************-->
<script type="text/javascript">
	<?php
	echo "var discounts={";
	foreach($dis as $d)	echo "'".$d->id."':['".$d->name."','".$d->type."'],";
	echo "};\n";
	echo $strforjs."];\n";
	?>

$(document).ready ( function (){

        $.ajaxSetup({cache:true});
	$("#changebt").click( function(){
	 <?php echo CHtml::ajax(array(
            'url'=>array('ajaxInfo'),
	         'data'=>  array(
				 'id_sched'=>$sched->idseg_scheduled_tours,
				 'date'=>$sched['date'],
				 'time'=>$sched['starttime']),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    $('#modal-data').html(data.div);
                 }
                else
                {
                    $('#modal-data').html(data.div);
                }
 
            } ",
            ))?>;
    return true; 
 });
 	$("#creditcard").click( function(){
	 <?php echo CHtml::ajax(array(
            'url'=>array('ajaxCreditCard'),
	         'data'=>  array(
                                'id_sched'=>$id_sched,
                                'sumtopay'=>'js:getasum()',
				 'date'=>$sched['date'],
				 'time'=>$sched['starttime']),
            'type'=>'post',
             'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure'){
//                    psqdata = $.parseJSON(data.div);
                     $('#card-title-data').html(data.sum);
                  $('#card-modal-data').html(data.div.html);
                 }
                else
                {
                    psqdata = $.parseJSON(data.div);
                   $('#card-modal-data').html(psqdata.html);
                }
 
            } ",
            ))?>;
    return true; 
 });
 counttotals();
<?php if ($jcode['result']=="success") echo "$('#paysuccess').show();"; ?>
});

	 
function discount(id,k){
		 k = parseInt(k.replace(/\D+/g,""));//номер строки 
                var disval=parseInt(document.getElementById('payoption'+k).value);
//                var disval=document.getElementById('payoption'+k).value;
		if(!( disval>0)){
                    counttotals();
                    return;
                }
		 var price=0;
		 var val,type;
		 if(id==""){
			val = 0;
			type = "%";
		 }
		 else
		 {
		  val = discounts[id][0];
 		  type = discounts[id][1];
		 }
		 var base_price = parseInt(document.getElementById('base_price'+k).innerHTML);
		 if(type=='euro'){
			price =base_price-val;
		 }
		 if(type=='%'){
			 price = base_price-base_price*val/100;
		 }
		 price = price.toFixed(2);
			document.getElementById('price'+k).innerHTML = price;
			document.getElementById('price_i'+k).value = price;
//		 alert(val+":"+type+":"+base_price);return;
		 countvat(price,k);
		 counttotals();
}
function countvat(price,k)
{	
		 var vat_nds = document.getElementById('vat_nds').innerHTML;//НДС
		var vat=0;
		 var price_vat = price;
		 var d1,d2;
		 d1 = vat_nds/100+1;
		 d2 = 1- 1/d1;
	
		 vat = price_vat*d2;
		 vat = vat.toFixed(2);
		 document.getElementById('vat'+k).innerHTML = vat;

}
function cash(id,k)
{
	 k = parseInt(k.replace(/\D+/g,""));//номер строки
		if(id>0){
		 var base_price = parseFloat(document.getElementById('base_price'+k).innerHTML);
		 var price;
		discounttype_id = document.getElementById('discounttype_id'+k).value;
		 if(discounttype_id==""){
			val = 0;
			type = "%";
		 }
		 else
		 {
		  val = discounts[discounttype_id][0];
 		  type = discounts[discounttype_id][1];
		 }
		 if(type=='euro'){
			price =base_price-val;
		 }
		 if(type=='%'){
			 price = base_price-base_price*val/100;
		 }
		document.getElementById('price_i'+k).value = price;
		 document.getElementById('price'+k).innerHTML = price;
		countvat(price,k);
	}
	else
	{
		document.getElementById('price_i'+k).value = 0;
		 document.getElementById('vat'+k).innerHTML = "0";
		 document.getElementById('price'+k).innerHTML = "0";
	}
	counttotals();
}
 function getasum() {
	var price = document.getElementById('price_card').innerHTML;
        return price;
 }
 /*
  * to do:
  * 1.we need to change the system of payment: count again with the users (old payments by catd must be checked and disabled)
  * 2.reload the page after each payment to block other card payments
  * 3.
  */
     function counttotals() {
		var vat_nds = document.getElementById('vat_nds').innerHTML;//НДС
	 	 var i;
		 var price_su=0;
		 var price_s=0;
		 var price_v=0;
		 var price_sv=0;
		 var price_card=0;
		 var pay;
		 var price_cash =0;
		 var discounttype_id, payment_id;

		 for	(index = 0; index < custs.length; index++) {
			i = custs[index];
			pay = document.getElementById('payoption'+i).value;
				//проверка какое значение выбрано в поле discount
				discounttype_id = document.getElementById('discounttype_id'+i).value;
				payment_id = document.getElementById('payoption'+i).value;
				if(payment_id==3){
					document.getElementById('creditcard'+i).style.display = 'block';
                                }
                                else  {
 					document.getElementById('creditcard'+i).style.display = 'none';
                                 }
				if(discounttype_id==42){
					document.getElementById('option'+i).style.display = 'block';
					document.getElementById('payoption'+i).style.display = 'none'; 
					document.getElementById('creditcard'+i).checked = false;
					document.getElementById('creditcard'+i).style.display = 'none';
				}else{
					document.getElementById('option'+i).style.display = 'none';
					document.getElementById('payoption'+i).style.display = 'block'; 
				}
		
				if(discounttype_id!=42){
					if(pay!=""){
						price_su = parseFloat(document.getElementById('price_i'+i).value);
						price_s = parseFloat(price_s)+price_su;
						d1 = vat_nds/100+1;
						d2 = 1- 1/d1;
						price_v = parseFloat(price_s)*d2;
						//price_v = parseFloat(price_s)*vat_nds/100;
						price_sv = parseFloat(price_s)-parseFloat(price_v);
						if(pay==1) price_cash = parseFloat(price_cash)+price_su;
                                                if(document.getElementById('creditcard'+i).checked) price_card=price_card+price_su ;
					}
				}
		 }
		 price_s = price_s.toFixed(2);
		 price_v = price_v.toFixed(2);
		 price_sv = price_sv.toFixed(2);
		 price_cash = price_cash.toFixed(2);
		 price_card = price_card.toFixed(2);
		 document.getElementById('price_s').innerHTML = price_s;
		 document.getElementById('price_v').innerHTML = price_v;
		 document.getElementById('price_sv').innerHTML = price_sv;
		 document.getElementById('price_cash').innerHTML = price_cash;
                 document.getElementById('price_card').innerHTML = price_card;
	
 }
 function newtourist() {
	document.forms['current-subscriber-form']['pdf'].value=1;
	document.forms['current-subscriber-form'].submit();
}
</script>