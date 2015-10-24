<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<!-- Modal -->
		 <div class="modal modal-primary fade" id="guideModal" role="dialog">
		   <div class="modal-dialog modal-md">
			 <div class="modal-content">
			   <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal" aria-label="close">
					 <span aria-hidden="true">&times;</span></button>
				 <h4 class="modal-title">Guides info</h4>
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
			<h1>Current Subscriber</h1>
			<ol class="breadcrumb">
				<li>
					<?php echo chtml::link('Scheduled Tours',array('guide/scedule')); ?>
				</li>
				<li class="active"> Current Subscriber
				</li>
			</ol>	
			<button id="changebt" type="button" class="btn btn-primary cancel" data-toggle="modal" data-target="#guideModal">Guide's info</button>

		</section>

        <!-- Main content -->
        <section class="content">


		<!-- param -->
			<div class="row">
			<div class="col-md-8">
			<div class="row create">
			<div class="col-md-4 create-left">

				<?php $i=0; 
				$id_c = $model[0]->booking->contact->idcontacts;
				 echo $model[0]->booking->sched->tourroute_ob['name']." "
						 .$model[0]->booking->sched['date']." "
						 .$model[0]->booking->sched['starttime'];
				 $element = 0; $k=0;$i=1;
				 ?>
			</div>
			<div class="col-md-4">
				<?php echo CHtml::link("New tourist","javascript:void(0);",array('onclick'=>'newtourist();')); ?>
			</div>	
		<div class="col-md-4">
		</div>
		</div>
		<div style="display:none;" id="count"><?php echo count($model);?></div>
		<div style="display:none;" id="vat_nds"><?php echo $vat_nds;?></div>
		<div class="row">
		<div class="col-md-8">

		<div class="form">
	
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'current-subscriber-form',
			'enableAjaxValidation'=>false,
		)); 
	
		?>
		<input type="hidden" name="new_customer" id="new_customer" value="0">

		<table border='1' cellpadding="5" cellspacing="5">
			<tr>
				<th>Tourist</th>
				<th>Nr</th>
				<th>Name</th>
				<th>Discount</th>
				<th>Payment</th>
				<th>Price</th>
				<th>Vat</th>
				<th>Options</th>
			</tr>
				<?php if(!empty($model))
					{ 
						foreach($dis as $d) {
								$d->nametype = $d->name.' '.$d->type;
								 } 
						 $list_discount = CHtml::listData($dis, 'id', 'nametype'); 
				for($element=0;$element < count($model);$element++)
					{
						echo "<tr><td>";
							echo $model[$element]->booking->contact->idcontacts;
						echo "</td><td>\n";
						 if($id_c == $model[$element]->booking->contact->idcontacts){}
						 else{	$i = 1;	}
						$id_c = $model[$element]->booking->contact->idcontacts;						
						$gs = $model[$element]->booking->groupsize - $model[$element]->booking->groupsize + $i;
						$i++;
						echo $gs;
						echo "</td><td>\n";
						if($model[$element]->customersName == '') $model[$element]->customersName = $model[$element]->booking->contact->firstname.' '. $model[$element]->booking->contact->surname;
						echo $form->textField($model[$element],'customersName',array('style'=>'width:170px','name'=>'customersName'.$k)); 
						echo "</td><td>\n";
						 echo '<div style="display:none;">';
						foreach($dis as $d){ 
							echo '<div id="i'.$k.'ii'.$d->id.'" >'.$d->val.'</div>';
							echo '<div id="j'.$k.'jj'.$d->id.'" >'.$d->type.'</div>';
							 }
							echo '<div id="i'.$k.'ii0" >0</div>';
							echo '<div id="j'.$k.'jj0" >euro</div>';
						echo "</div>\n";
						echo '<div style="display:none;" id="discount'.$k.'" >'.$model[$element]->discounttype_id.'</div>';
						echo '<select name="discounttype_id'.$k.'" id="discounttype_id'.$k.'" onChange="price(value,this.id)" style="width:170px;">';
						echo '<option value="0">--</option>';
						foreach($dis as $d){
							echo '<option value="'.$d->id.'" ';
							if ($model[$element]->discounttype_id==$d->id)
								echo 'selected ';
							echo '>'.$d->nametype.'</option>';
						}
						echo "</select></td><td>\n";
						echo '<select name="payoption'.$k.'" style="width:170px;" id="payoption'.$k.'" onChange="cash()">';
						echo '<option value="0">--</option>';
						foreach($pay as $p){
							echo '<option value="'.$p->idpayoptions.'" ';
							if($model[$element]->paymentoptionid==$p->idpayoptions) 
								echo "selected";
							echo '>'.$p->displayname.'</option>';
						}
						echo "</select></td><td>\n";
						$bp = $model[$element]->booking->sched->tourroute_ob['base_price'];
						echo '<input type="hidden" id="base_price" value = "'.$bp.'" >';
						echo '<div id="price'.$k.'" style="float:left;">';
						 if ($model[$element]->price==null){ echo $bp; } else { echo $model[$element]->price; } 
						echo '</div><div style="float:left;"> &euro;</div>';
						echo '<div style="clear:both;"></div>';
						echo '<input type="hidden" id="price_i'.$k.'" name="price<? echo $k;?>" >';
						echo '</td><td style="width:40px;">';
						if($model[$element]->price==null){
									$vat_value = $bp*(1-1/($vat_nds/100+1));
								} else {
									$vat_value = $model[$element]->price*(1-1/($vat_nds/100+1));
								}
								$vat_value = number_format($vat_value, 2, '.', ' ');
						echo '<div id="vat'.$k.'" style="float:left;">'.$vat_value.'</div><div style="float:left;"> &euro;</div>';
						echo '<div style="clear:both;"></div>';
						$vat_input = 'vat_i'.$k;
						echo '<input type="hidden" id="'.$vat_input.'" name="vat'.$k.'">';
						echo "</td><td>\n";
						echo '<select name="option'.$k.'" id="option'.$k.'" ostyle="width:170px;">';
						echo '<option>--</option>';
						foreach($invoiceoptions_array as $p){
							echo '<option value="'.$p->id.'" ';
							if ($model[$element]->id_invoiceoptions==$p->id) echo 'selected'; 
							echo '>'.$p->name.'</option>';
						}
						echo "</select></td></tr>\n";
						$k++;
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

		<div style="font-size:14px;font-weight:bold;padding:20px 0;">

			<div style="float:left;width:250px;">Total revenue excluding VAT: </div><div style="float:left;width:100px;" id="price_sv"></div>
			<div style="float:left;"> &euro;</div>
			<div style="clear:both;"></div>
			<input type="hidden" name="price_s_post" id="price_s_post">
			<hr>

			<div style="float:left;width:250px;">Sales tax:</div><div style="float:left;width:100px;" id="price_v"></div>
			<div style="float:left;"> &euro;</div>
			<div style="clear:both;"></div>
			<input type="hidden" name="price_v_post" id="price_v_post">
			<hr>

			<div style="float:left;width:250px;">Total revenue: </div><div style="float:left;width:100px;" id="price_s"></div>
			<div style="float:left;"> &euro;</div>
			<div style="clear:both;"></div>
			<input type="hidden" name="price_sv_post" id="price_sv_post">
			<hr>

			<div style="float:left;width:250px;">Share of cash income includes tax: </div><div style="float:left;width:100px;" id="price_cash"></div>
			<div style="float:left;"> &euro;</div>
			 <div style="clear:both;"></div>
			 <input type="hidden" name="price_cash_post" id="price_cash_post">
			 <hr>
		</div>     

		<!-- *********************** BUTTINS ***************************************************************-->
		<div class="row buttons">
				<button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
				<button class="btn btn-primary cancel">
					<a href="<?php echo Yii::app()->request->baseUrl; ?>/segGuidestourinvoicescustomers/createpdf/id_invoice/<? echo $model[0]->tourInvoiceid;?>/id_tour/<? echo $model[0]->booking->sched['tourroute_id'];?>"><?php echo 'PDF'; ?>
					</a>
				</button>
				<button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segScheduledTours/admin"><?php echo 'Cancel'; ?></a></button>
		</div>

		<?php
		$this->endWidget();
		?>

</div><!-- form -->
	
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->



<!-- *********************** javascript ***************************************************************-->
<script type="text/javascript">
$(document).ready ( function (){
	var i;
	var price=0;
	var price_s=0;
	var pay;
	var price_cash =0;
	var discounttype_id = 0;
	var d1,d2;
	var vat_nds = document.getElementById('vat_nds').innerHTML;//НДС
	var count = document.getElementById('count').innerHTML;// количество всех строчек
	$("#changebt").click( function(){
	 <?php echo CHtml::ajax(array(
            'url'=>array('SegGuidestourinvoicescustomers/ajaxInfo'),
	         'data'=>  array(
				 'id_sched'=>$model[0]->booking->sched->idseg_scheduled_tours,
				 'date'=>$model[0]->booking->sched['date'],
				 'time'=>$model[0]->booking->sched['starttime']),
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
	for(i=0;i<count;i++){
			//проверка какое значение выбрано в поле discount
			discounttype_id = document.getElementById('discounttype_id'+i).value;
			if(discounttype_id==42){
				document.getElementById('option'+i).style.display = 'block';
				document.getElementById('payoption'+i).style.display = 'none'; 
			}else{
				document.getElementById('option'+i).style.display = 'none';
				document.getElementById('payoption'+i).style.display = 'block';
			}
		
			price = document.getElementById('price'+i).innerHTML;
			pay = document.getElementById('payoption'+i).value;
			if(discounttype_id!=42){
				if(pay!=0){
					price_s = parseFloat(price_s)+parseFloat(price);
					
					d1 = vat_nds/100+1;
					d2 = 1- 1/d1;

					price_v = parseFloat(price_s)*d2;
					price_sv = parseFloat(price_s)-parseFloat(price_v);
				}
				if(pay==1) price_cash = parseFloat(price_cash)+parseFloat(price);	
			}
	}
	price_s = price_s.toFixed(2);
	price_v = price_v.toFixed(2);
	price_sv = price_sv.toFixed(2);
	price_cash = price_cash.toFixed(2);
	document.getElementById('price_s').innerHTML = price_s;
	document.getElementById('price_v').innerHTML = price_v;
	document.getElementById('price_sv').innerHTML = price_sv;
	document.getElementById('price_cash').innerHTML = price_cash;
	document.getElementById('price_s_post').value = price_s;
	document.getElementById('price_v_post').value = price_v;
	document.getElementById('price_sv_post').value = price_sv;
	document.getElementById('price_cash_post').value = price_cash;

});

	 
function price(id,k){
		 var vat_nds = document.getElementById('vat_nds').innerHTML;//НДС
		 k = parseInt(k.replace(/\D+/g,""));//номер строки
		 var price;
		 var val = document.getElementById('i'+k+'ii'+id).innerHTML;
 		 var type = document.getElementById('j'+k+'jj'+id).innerHTML;
		 var base_price = document.getElementById('base_price').value;
		 if(type=='euro'){
			price =base_price-val;
		 }
		 if(type=='%'){
			 price = base_price-base_price*val/100;
		 }
		 price = price.toFixed(2);
		 document.getElementById('price'+k).innerHTML = price;
		 document.getElementById('price_i'+k).value = price;
		 
		 var vat;
		 var price_vat = document.getElementById('price'+k).innerHTML;
		 var d1,d2;
		 d1 = vat_nds/100+1;
		 d2 = 1- 1/d1;
	
		 vat = price_vat*d2;
		 vat = vat.toFixed(2);
		 document.getElementById('vat'+k).innerHTML = vat;
		 document.getElementById('vat_i'+k).value = vat;		 
	 
		 var i;
		 var price_su=0;
		 var price_s=0;
		 var pay;
		 var price_cash =0;

		 var count = document.getElementById('count').innerHTML;
		 for(i=0;i<count;i++){
				pay = document.getElementById('payoption'+i).value;
				//проверка какое значение выбрано в поле discount
				discounttype_id = document.getElementById('discounttype_id'+i).value;
				if(discounttype_id==42){
					document.getElementById('option'+i).style.display = 'block';
					document.getElementById('payoption'+i).style.display = 'none'; 
				}else{
					document.getElementById('option'+i).style.display = 'none';
					document.getElementById('payoption'+i).style.display = 'block'; 
				}
		
				if(discounttype_id!=42){
					if(pay!=0){
						price_su = document.getElementById('price'+i).innerHTML;
						price_s = parseFloat(price_s)+parseFloat(price_su);
						d1 = vat_nds/100+1;
						d2 = 1- 1/d1;
						price_v = parseFloat(price_s)*d2;
						//price_v = parseFloat(price_s)*vat_nds/100;
						price_sv = parseFloat(price_s)-parseFloat(price_v);
						if(pay==1) price_cash = parseFloat(price_cash)+parseFloat(price_su);
					}
				}
		 }
		 price_s = price_s.toFixed(2);
		 price_v = price_v.toFixed(2);
		 price_sv = price_sv.toFixed(2);
		 price_cash = price_cash.toFixed(2);
		 document.getElementById('price_s').innerHTML = price_s;
		 document.getElementById('price_v').innerHTML = price_v;
		 document.getElementById('price_sv').innerHTML = price_sv;
		 document.getElementById('price_cash').innerHTML = price_cash;
		 document.getElementById('price_s_post').value = price_s;
		 document.getElementById('price_v_post').value = price_v;
		 document.getElementById('price_sv_post').value = price_sv;
		 document.getElementById('price_cash_post').value = price_cash;
}

function cash()
{
	var vat_nds = document.getElementById('vat_nds').innerHTML;//НДС
	var i;
	var price=0;
	var price_su=0;
	var price_s=0;
	var pay;
	var price_cash =0;
	var count = document.getElementById('count').innerHTML;
	for(i=0;i<count;i++){
			pay = document.getElementById('payoption'+i).value;
			discounttype_id = document.getElementById('discounttype_id'+i).value;
			if(discounttype_id!=42){
				if(pay!=0){
					price = document.getElementById('price'+i).innerHTML;
					price_s = parseFloat(price_s)+parseFloat(price);
					d1 = vat_nds/100+1;
					d2 = 1- 1/d1;
					price_v = parseFloat(price_s)*d2;
					//price_v = parseFloat(price_s)*vat_nds/100;
					price_sv = parseFloat(price_s)-parseFloat(price_v);
				}
				if(pay==1) price_cash = parseFloat(price_cash)+parseFloat(price);
			}
	}
	price_s = price_s.toFixed(2);
	price_v = price_v.toFixed(2);
	price_sv = price_sv.toFixed(2);
	price_cash = price_cash.toFixed(2);
	document.getElementById('price_s').innerHTML = price_s;
	document.getElementById('price_v').innerHTML = price_v;
	document.getElementById('price_sv').innerHTML = price_sv;
	document.getElementById('price_cash').innerHTML = price_cash;
		 document.getElementById('price_s_post').value = price_s;
		 document.getElementById('price_v_post').value = price_v;
		 document.getElementById('price_sv_post').value = price_sv;
		 document.getElementById('price_cash_post').value = price_cash;

}
 function newtourist() {
	document.forms['current-subscriber-form']['new_customer'].value=1;
	document.forms['current-subscriber-form'].submit();
}
</script>