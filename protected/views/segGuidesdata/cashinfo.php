<?php
$this->breadcrumbs=array(
    'Users'=>array('user/admin'),
	$user->username=>array('user/update/id/'.$user->id),
	'Update guide information'=>array('segGuidesdata/update/id/'.$guidesdata->idseg_guidesdata.'/id_user/'.$user->id),
	'Update cash information',
);

?>

<h1>Update cash information -  <?php echo $user->username; ?></h1>

<div class="text-h2">General information</div>

<? if($prim==1){ ?>
	<div class="successfully">Data saved successfully</div>

<? } ?>
<div style="padding:20px;"></div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cash_box-form',
	'enableAjaxValidation'=>false,
)); ?>

<table class="info-table">
	<tr>
    	<td>Current cashbox</td>
        <td><? echo $guidesdata->cash_box; ?></td>
    	<td>Sales tax</td>
        <td>
		<? echo $form->radioButtonList(
			$guidesdata,
			'paysUSt', 
			array('1'=>'Yes','0'=>'No'), 
			array(
    			'labelOptions'=>array('style'=>'display:inline;'), 
    			'separator'=>'  ',
				//'empty'=>'1',
			) 
		); ?></td>        
    </tr>
    <tr>
    	<td colspan="2">Billings 2015</td>
        <td colspan="2"><?php echo $form->textField($guidesdata,'inVoiceCount2015'); ?></td>
    </tr>
	<tr>
    	<td>Tax number</td>
        <td><?php echo $form->textField($guidesdata,'taxnumber'); ?></td>
    	<td>Tax office</td>
        <td><?php echo $form->textField($guidesdata,'taxoffice',array('size'=>45,'maxlength'=>45)); ?></td>
    </tr>
    <tr>
    	<td colspan="2">BIC</td>
        <td colspan="2"><?php echo $form->textField($guidesdata,'BIC'); ?></td>
    </tr>
    <tr>
    	<td colspan="2">IBAN</td>
        <td colspan="2"><?php echo $form->textField($guidesdata,'IBAN'); ?></td>
    </tr>
</table>

<div style="padding:20px;"></div>
<div class="row buttons">
    <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
    <button class="btn btn-primary cancel">
    	<a href="<?php echo Yii::app()->request->baseUrl; ?>/segGuidesdata/update/id/<?php echo $guidesdata->idseg_guidesdata;?>/id_user/<? echo $user->id;?>">
			<?php echo 'Cancel'; ?>
        </a>
    </button>
</div>
<?php $this->endWidget(); ?>

<div style="padding:20px;"></div>

<div class="text-h2">Information tour routes</div>
<?php $form_t=$this->beginWidget('CActiveForm', array(
	'id'=>'cash_box-form',
	'enableAjaxValidation'=>false,
)); ?>
<? $count_col = count($array_tour);?>



<table class="info-table">
    <tr>
        <td></td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><? echo $array_tour[$k]['name'];?></td>
        <? } ?>
    </tr>
    <tr>
    	<td>Basic fee </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'base_provision'.$k); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Guest variable </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'guest_variable'.$k); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Guest variable ab x TN ->x </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'guestsMinforVariable'.$k); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Gutschei-VK commission </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'voucher_provision'.$k); ?></td>
        <? } ?>
    </tr>
</table>

<div style="padding:20px;"></div>
<div class="row buttons">
    <button class="btn btn-primary" type="submit"><?php echo 'Save'; ?></button>
    <button class="btn btn-primary cancel">
    	<a href="<?php echo Yii::app()->request->baseUrl; ?>/segGuidesdata/update/id/<?php echo $guidesdata->idseg_guidesdata;?>/id_user/<? echo $user->id;?>">
			<?php echo 'Cancel'; ?>
        </a>
    </button>
</div>

<?php $this->endWidget(); ?>