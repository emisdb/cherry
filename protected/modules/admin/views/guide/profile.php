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
			<h1>Benutzerprofil - <?php echo $model->username; ?></h1>

			<div class="create">
				<?php echo CHtml::link("Benutzerprofil aktualisieren",array("user",'id'=>$model->id)); ?>
			</div>
			BENUTZPROFIL
       </section>

        <!-- Main content -->
        <section class="content">

<?php 

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'profile',
	),
)); ?>

<hr />
<div class="create">
					<?php echo CHtml::link("Kontaktdaten aktualisieren",array("contact",'id_user'=>$model->id)); ?>
</div>
KONTAKTINFORMATIONEN
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
	echo "<hr />Homepageauftritt <hr />";

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
	echo "<hr />Stadt<hr />";
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
 	echo "<hr />Sprachen<hr />";

	if(isset($lan_obs)) { foreach($lan_obs as $lan_ob_user_item){
		echo "<div>".$lan_ob_user_item->englishname."</div>";
        echo "<div><img src='".Yii::app()->request->baseUrl."/img/lan/".$lan_ob_user_item->flagpic."' /></div>";
  		}
	}
	else { echo "No items languages";}

}
	?>  

    <hr />
    Kaßedaten
    <hr />
   <div class="text-h2">General information</div>
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cash_box-form',
	'enableAjaxValidation'=>false,
)); ?>
    <table class="info-table">
	<tr>
    	<td>Kassenbestand</td>
        <td><? echo $guidesdata->cash_box; ?></td>
    	<td>Umsatzsteuerpflichtig</td>
        <td>
		<? echo $form->radioButtonList(
			$guidesdata,
			'paysUSt', 
			array('1'=>'Ja','0'=>'Nein'), 
			array(
    			'labelOptions'=>array('style'=>'display:inline;','readonly'=>'readonly'), 
    			'separator'=>'  ',
				//'empty'=>'1',
			) 
		); ?></td>        
    </tr>
    <tr>
    	<td colspan="2">Rechnungsanzahl 2015</td>
        <td colspan="2"><?php echo $form->textField($guidesdata,'inVoiceCount2015',array('readonly'=>'readonly')); ?></td>
    </tr>
	<tr>
    	<td>Steuernummer</td>
        <td><?php echo $form->textField($guidesdata,'taxnumber',array('readonly'=>'readonly')); ?></td>
    	<td>Zuständiges Finanzamt</td>
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

<div class="text-h2">Tour Routen</div>
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
    	<td>Grundvergütung </td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'base_provision'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Minimum Gastanzahl</td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'guest_variable'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Variable Vergütung pro zusätzlichen Gast</td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'guestsMinforVariable'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
        <tr>
    	<td>Provision Gutscheinverkauf</td>
        <? for($k=0;$k<$count_col;$k++) {?>
        	<td><?php echo $form_t->textField($array_tour_link[$k],'voucher_provision'.$k,array('readonly'=>'readonly')); ?></td>
        <? } ?>
    </tr>
</table>
<?php $this->endWidget(); ?>        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


