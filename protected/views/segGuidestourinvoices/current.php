<?php
$this->breadcrumbs=array(
	'Scheduled Tours'=>array('admin'),
	'Current Subscriber',
);

?>

<h1>Current Subscriber</h1>

<!-- param -->
<? $i=0; 
//$id_c = $model[0]->contact->idcontacts;
?><!-- groupsize  - chet, id contact user -->	


<div><? echo $model[0]->booking->sched->tourroute_ob['name']; ?>
	 <? echo $model[0]->booking->sched['date']; ?>
     <? echo $model[0]->booking->sched['starttime']; ?>
</div>

<? $k=0;?>
<div style="display:none;" id="count"><? echo count($model);?></div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'current-subscriber-form',
	'enableAjaxValidation'=>false,
)); ?>


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
        <? if(!empty($model)){?>
        	<? foreach($model as $item){ ?>
            	<tr>
                 	<td><? echo $item->contact->idcontacts;?></td>
                    <td>
                    
						<? 
						if($id_c == $item->contact->idcontacts){
							
						}else{
							$i = 0;	
						}
						$id_c = $item->contact->idcontacts;						
						
                        
						$gs = $item->groupsize - $item->groupsize + $i;
						$i++;
						?>
                        
                        
                    	<? echo $gs;?>
                    </td>
                    <td><? echo $item->contact->firstname;?> <? echo $item->contact->surname;?></td>
                    <td>
                  
                        <? $dis = Bonus::model()->findAll(array('order'=>'sort ASC')); ?>
                        <? foreach($dis as $d) {?>
                        	<? $d->nametype = $d->name.' '.$d->type;?>
                        <? } ?>
                        <?php $list_discount = CHtml::listData($dis, 'id', 'nametype');  ?>
          
                        <div style="display:none;">
                        	<? foreach($dis as $d){ ?>
                            	<div id="i<? echo $k;?>ii<? echo $d->id;?>"><? echo $d->val;?></div>
                                <div id="j<? echo $k;?>jj<? echo $d->id;?>"><? echo $d->type;?></div>
                            <? } ?>
                        </div>
                        
                        <!--<php echo $form->DropDownList($item,'rabatt["name"]',$list_discount1,array('empty'=>'--','onchange'=>'price(value,this.id)', 'id'=>$k)); ?>
                    	<php echo $form->error($item,'rabatt["name"]');?>-->
                        <select name="rabatt<? echo $k;?>" id="<? echo $k;?>" onChange="price(value,this.id)">
                        	<option>--</option>
                            <? foreach($dis as $d){?>
                            	<option value="<? echo $d->id;?>"><? echo $d->nametype;?></option>
                            <? } ?>
                        </select>
                        
                    </td>
                    <td>
                        <? $pay = Payoptions::model()->findAll();?>
                    	<!--<php $list_pay = CHtml::listData($pay, 'idpayoptions', 'displayname');  ?>
                        <php echo $form->dropDownList($item,'payoption["displayname"]',$list_pay,array('empty'=>'--')); ?>
                    	<php echo $form->error($item,'payoption["displayname"]');?>-->
                        <select name="payoption<? echo $k;?>">
                        	<option>--</option>
                            <? foreach($pay as $p){?>
                            	<option value="<? echo $p->idpayoptions;?>"><? echo $p->displayname;?></option>
                            <? } ?>
                        </select>
                    </td>
                    <td>
                    	<input type="hidden" id="base_price" value = "<? echo $item->sched->tourroute_ob['base_price'];?>" > 
                        <div id="price<? echo $k;?>" style="float:left;"><? echo $item->sched->tourroute_ob['base_price'];?></div><div style="float:left;"> &euro;</div>
                        <div style="clear:both;"></div>
                        <? $price_input = 'price_i'.$k;?>
                       <!-- < $price_input1 = $k;?>

                        < echo $form->hiddenField($item,'price',array('id'=>$price_input1));?>-->
                       
                        <input type="hidden" id="<? echo $price_input; ?>" name="price<? echo $k;?>" >
                        
                        
                    </td>
                    <td>
                    	<? $vat_value = $item->sched->tourroute_ob['base_price']*19/100;?>
                        <div id="vat<? echo $k;?>" style="float:left;"><? echo $vat_value;?></div><div style="float:left;"> &euro;</div>
                        <div style="clear:both;"></div>
                        <? $vat_input = 'vat_i'.$k;?>
                        <input type="hidden" id="<? echo $vat_input; ?>" name="vat<? echo $k;?>" >
                    
                    </td>
                    <td>
                        <select name="option<? echo $k;?>">
                        	<option>--</option>
                            <option value="0">Gast hat abgesagt</option>
                            <option value="1">Gast wurde durch andere Gaste entschuldigt</option>
                            <option value="2">Gast wurde durch office entschuldigt</option>
                            <option value="3">Gast wurde kontaktiert und hat sich erklart</option>
                            <option value="4">Gast wurde nicht erreicht, keine Absage erhalten</option>
                        </select>
                    
                    </td>
                </tr>
                <? $k++;?>
            <? } ?>
        <? }else{ ?>
        	<tr>
        		<td colspan="8">no current</td>
            </tr>
        <? } ?>

    
    

</table>
	
<div style="font-size:14px;font-weight:bold;padding:20px 0;">

	<div style="float:left;width:100px;">PRICE </div><div style="float:left;width:100px;" id="price_s"></div><div style="float:left;"> &euro;</div>
    <div style="clear:both;"></div>
    <hr>
    <div style="float:left;width:100px;">VAT</div><div style="float:left;width:100px;" id="price_v"></div><div style="float:left;"> &euro;</div>
    
     <div style="clear:both;"></div>
     <hr>
    <div style="float:left;width:100px;">PRICE - VAT </div><div style="float:left;width:100px;" id="price_sv"></div><div style="float:left;"> &euro;</div>
     <div style="clear:both;"></div>
     <hr>
</div>     
    
<!--
	<div class="row-form">
		<php echo $form->labelEx($model,'duration'); ?>
		<php echo $form->textField($model,'duration'); ?>
		<php echo $form->error($model,'duration'); ?>
	</div>
    -->
    
    
     

    	



	

	<div class="row buttons">
      	<button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segScheduledTours/admin"><?php echo 'Cancel'; ?></a></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->




<script type="text/javascript">
$(document).ready ( function (){
	var i;
	var price=0;
	var price_s=0;
	var count = document.getElementById('count').innerHTML;
	for(i=0;i<count;i++){
			price = document.getElementById('price'+i).innerHTML;

			
			price_s = parseFloat(price_s)+parseFloat(price);
			price_v = parseFloat(price_s)*19/100;
			price_sv = parseFloat(price_s)-parseFloat(price_v);
			//alert(price_s);
	}
	document.getElementById('price_s').innerHTML = price_s;
	document.getElementById('price_v').innerHTML = price_v;
	document.getElementById('price_sv').innerHTML = price_sv;

});

function price(id,k){
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
		 document.getElementById('price'+k).innerHTML = price;
		 document.getElementById('price_i'+k).value = price;
		 
		 var vat;
		 var price_vat = document.getElementById('price'+k).innerHTML;
		 vat = price_vat*19/100;
		 document.getElementById('vat'+k).innerHTML = vat;
		 document.getElementById('vat_i'+k).value = vat;		 
		 
		 
		 var i;
		 var price_su=0;
		 var price_s=0;
		 var count = document.getElementById('count').innerHTML;
		 for(i=0;i<count;i++){
				price_su = document.getElementById('price'+i).innerHTML;
	
				
				price_s = parseFloat(price_s)+parseFloat(price_su);
				price_v = parseFloat(price_s)*19/100;
				price_sv = parseFloat(price_s)-parseFloat(price_v);

		 }
		 
		 document.getElementById('price_s').innerHTML = price_s;
		 document.getElementById('price_v').innerHTML = price_v;
		 document.getElementById('price_sv').innerHTML = price_sv;
		 
		 
}
</script>