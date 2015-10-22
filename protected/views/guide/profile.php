 <?php $this->renderPartial('_top', array('info'=>$info)); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<?php
			$this->breadcrumbs=array(
				'Profile',
			);
			?>
			<h1>Profile information user - <?php echo $model->username; ?></h1>

			<div class="create"><a href="<?php echo Yii::app()->createUrl('/guide/user',array('id'=>$model->id)); ?>">Update profile information</a></div>
			PROFILE INFORMATION
       </section>

        <!-- Main content -->
        <section class="content">

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'profile',
	),
)); ?>

<hr />
<div class="create"><a href="<?php echo Yii::app()->createUrl('/guide/contact',array('id'=>$model->id,'id_user'=>$model->id)); ?>">Update profile contact</a></div>
CONTACTS
<hr />

    <?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model->contact_ob,
	'attributes'=>array(
		'firstname',
		'surname',
        'phone',
        'email',
        'additional_address',
        'country',
        'city',
        'postalcode',
        'house',
        'street',
        'birthdate',
	),
)); ?>

<?php if ($model->id_guide!=0){
	echo "<hr /> GUIDE'S DATA   <hr />";

    $this->widget('zii.widgets.CDetailView', array(
	    'data'=>$model->guide_ob,
        'attributes'=>array(
    	//	'idseg_guidesdata',
    	//	'base_provision',
    	//	'cash_box',
            'guide_shorttext',
            'guide_maintext',
            'lnk_to_picture',
           // 'guest_variable',
           // 'paysUSt',
            //'guestsMinforVariable',
           // 'taxnumber',
           // 'taxoffice',  
	   ),
    )); 
	echo "<hr />CITY<hr />";
 if(!empty($city)){echo $city->seg_cityname;
 } else {echo "No item city"; } 
 	echo " <hr /> TOUR ROUTES <hr />";
 if(isset($tourcat)) 
	 {
		foreach($tourcat as $tourcati){
		echo "(".$tourcati->cat.")";
		echo $tourcati->tourname."<br />";
		}  
	 }
	 else { echo "No items tourroutes";
 } 
 	echo "<hr />LANGUADGE <hr />";

	if(isset($lan_obs)) { foreach($lan_obs as $lan_ob_user_item){
		echo "<div>".$lan_ob_user_item->englishname."</div>";
        echo "<div><img src='".Yii::app()->request->baseUrl."/img/lan/".$lan_ob_user_item->flagpic."' /></div>";
  		}
	}
	else { echo "No items languages";}

}
	?>  

    <hr />
    CASH INFO
    <hr />
   <div class="text-h2">General information</div>
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
    			'labelOptions'=>array('style'=>'display:inline;','readonly'=>'readonly'), 
    			'separator'=>'  ',
				//'empty'=>'1',
			) 
		); ?></td>        
    </tr>
    <tr>
    	<td colspan="2">Billings 2015</td>
        <td colspan="2"><?php echo $form->textField($guidesdata,'inVoiceCount2015',array('readonly'=>'readonly')); ?></td>
    </tr>
	<tr>
    	<td>Tax number</td>
        <td><?php echo $form->textField($guidesdata,'taxnumber',array('readonly'=>'readonly')); ?></td>
    	<td>Tax office</td>
        <td><?php echo $form->textField($guidesdata,'taxoffice',array('size'=>45,'maxlength'=>45,'readonly'=>'readonly')); ?></td>
    </tr>
    <tr>
    	<td colspan="2">BIC</td>
        <td colspan="2"><?php echo $form->textField($guidesdata,'BIC',array('readonly'=>'readonly')); ?></td>
    </tr>
    <tr>
    	<td colspan="2">IBAN</td>
        <td colspan="2"><?php echo $form->textField($guidesdata,'IBAN',array('readonly'=>'readonly')); ?></td>
    </tr>
</table>


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
        	<td><?php echo $form_t->textField($array_tour_link[$k],'base_provision'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Guest variable </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'guest_variable'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Guest variable ab x TN ->x </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'guestsMinforVariable'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Gutschei-VK commission </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'voucher_provision'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
</table>
<?php $this->endWidget(); ?>        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


