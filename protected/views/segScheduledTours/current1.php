<?php

$this->breadcrumbs=array(
	'Scheduled Tours'=>array('admin'),
	'Current Subscriber',
);

?>

<h1>Current Subscriber</h1>

<div><? echo $model[0]->tour['name']; ?>
	 <? echo $model[0]->scheduled['date']; ?>
     <? echo $model[0]->scheduled['starttime']; ?>
</div>

<? $k=0;?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'current-subscriber-form',
	'enableAjaxValidation'=>false,
)); ?>

	
<table border='1' cellpadding="5" cellspacing="5">
	<tr>
    	<th>TouristNr</th>
        <th>Name</th>
        <th>Tourist</th>
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
                    <td><? echo $item->contact->firstname;?> <? echo $item->contact->surname;?></td>
                    <td>
						<!--<php $list_tourist = array('0'=>'No', '1'=>'Yes'); ?>
                        <php echo $form->dropDownList($item,'tourist',$list_tourist,array('empty'=>'--','style'=>'width:70px;')); ?>
                    	<php echo $form->error($item,'tourist'); ?>-->
                        <select style="width:70px;" name="tourist"<? echo $k;?>>
                        	<option>--</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        
                    </td>
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
                        <select name="rabatt"<? echo $k;?> id="<? echo $k;?>" onChange="price(value,this.id)">
                        	<option>--</option>
                            <? foreach($list_discount as $discount_item){?>
                            	<option value="<? echo $discount_item->id;?>"><? echo $discount_item->nametype;?></option>
                            <? } ?>

                        </select>
                        
                    </td>
                    <td>
                        <? $pay = Payoptions::model()->findAll();?>
                    	<?php $list_pay = CHtml::listData($pay, 'idpayoptions', 'displayname');  ?>
                        <?php echo $form->dropDownList($item,'payoption["displayname"]',$list_pay,array('empty'=>'--')); ?>
                    	<?php echo $form->error($item,'payoption["displayname"]');?>
                    </td>
                    <td>
                    	<input type="hidden" id="base_price" value = "<? echo $item->tour->base_price;?>" > 
                        <div id="price<? echo $k;?>" style="float:left;"><? echo $item->tour->base_price;?></div><div style="float:left;"> &euro;</div>
                        <? $price_input = 'price_i'.$k;?>
                        <? $price_input1 = $k;?>

                        <? echo $form->hiddenField($item,'price',array('id'=>$price_input1));?>
                       
                        <input type="hidden" id="<? echo $price_input; ?>" name="it<? echo $k;?>" >
                        
                        <div style="clear:both;"></div>
                    </td>
                    <td>
                    	<? $vat_value = $item->tour->base_price*19/100;?>
                    	<div id="vat"><? echo $vat_value; ?></div>
                    
                    </td>
                    <td></td>
                </tr>
                <? $k++;?>
            <? } ?>
        <? }else{ ?>
        	<tr>
        		<td colspan="8">no current</td>
            </tr>
        <? } ?>

    
    

</table>
	
<!--
	<div class="row-form">
		<php echo $form->labelEx($model,'duration'); ?>
		<php echo $form->textField($model,'duration'); ?>
		<php echo $form->error($model,'duration'); ?>
	</div>
    -->
    
    
     

    	



	

	<div class="row buttons">
      	<button class="btn btn-primary" type="submit"><?php echo $model->isNewRecord ? 'New record' : 'Save'; ?></button>
        <button class="btn btn-primary cancel"><a href="<?php echo Yii::app()->request->baseUrl; ?>/segScheduledTours/officeadmin"><?php echo 'Cancel'; ?></a></button>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
/*<!--$(document).ready ( function (){
	var id = document.getElementById('price33').value;
 alert(id);
});-->*/

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
}
</script>