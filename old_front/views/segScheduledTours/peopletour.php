<?php
$this->breadcrumbs=array(

	'Accounting of funds',
);

?>
<style>
	.peopletour{
			margin-top:50px;
	}
</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'peopletour-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="peopletour">

	<table  border=1 class="peopletour11" cellpadding="10" cellspacing="10">
    		<tr>
            	<th>Id</th>
                <th>N</th>
                <th>Name</th>
                <th>Tourist </th>
                <th>Promotions </th>
                <th>Payment method</th>
                <th>Price </th>
                <th>VAT</th>
                <th>Note</th>
                
                
            </tr>
     
            	<? foreach($model as $item) { ?>
                <tr>
                	<td><? echo $item->id;?></td>
                    <td><? echo $item->number;?></td>
                    <td><? echo $item->name;?></td>
                    <td><? echo $item->tourist;?></td>
                    <td><? echo $item->promotions;?></td>
                    <td><? echo $item->method;?></td>
                    <td><? echo $item->price;?></td>
                    <td><? echo $item->vat;?></td>
                    <td><? echo $item->note;?></td>
                 </tr>
                <? } ?>
            
    </table>

</div>
<?php $this->endWidget(); ?>