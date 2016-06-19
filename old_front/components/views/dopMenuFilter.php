<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-filter',
	'enableAjaxValidation'=>false,
    // 'enableClientValidation' => true,
    // 'clientOptions' => array(
 	// 		'validateOnSubmit' => true,
 	// 		'validateOnChange' => true,
 	// ),
  	'action'=>Yii::app()->createUrl('SegScheduledTours/result'),
)); ?>
	
    
    <!-- CITY -->
    <div class="row-filter">      
		<!--<php $list = CHtml::listData($citys, 'idseg_cities', 'seg_cityname'); ?>-->
        <? $list =array('1'=>'Berlin','2'=>'Munchen');?>
        <?php echo $form->dropDownList($model,'city',$list); ?>
    </div>      
    <!--  <select name="city" class="" >--> <!--selected disabled-->
         <!-- <php foreach($citys as $city){?> -->
             <!--  <option value='<php echo $city->idseg_cities;?>' ><php echo $city->seg_cityname;?></option>-->
                      <!--<option value='1' >Berlin</option>
                      <option value='2' >Munich</option>-->
                <!--<php }?>-->
                <!--</select>-->
                
    <!-- DATE -->
    <div class="row-filter"> 
		<? $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'date_n',
			'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat' => 'dd.mm.yy',
                        'yearRange' => '2015:2020',
                        //'changeMonth' => true,
                        //'changeYear' => true,
                        'minDate' => 0, 
                      //  'defaultDate'=> time(),   
						'dateonly' => true,  
                        //'maxDate' => '2099-12-31',  
                        // 'onSelect'=> 'js: function(date) {if(date != "") { 
                        //    window.location.href = "'.CHtml::encode($this->createUrl('segScheduledtours/weeks'
                        //    )).'/date/"+date ;
                        // } }',
            ),
            'htmlOptions' => array(
                'size' => '10',         // textField size
                'maxlength' => '10',    // textField maxlength
				'class'=>'form-control-date-filter',
            ),
        ));?>
     </div>
         
         
                 
    <!-- TIME -->
    <div class="row-filter">      
       <!-- < $list_time =array(
			'1'=>'09:00',
			'2'=>'09:30',
			'3'=>'10:00',
			'4'=>'10:30',
			'5'=>'11:00',
			'6'=>'11:30',
			'7'=>'12:00',
			'8'=>'12:30',
			'9'=>'13:00',
			'10'=>'13:30',
			'11'=>'14:00',
			'12'=>'14:30',
			'13'=>'15:00',
			'14'=>'15:30',
			'15'=>'16:00',
			'16'=>'16:30',
			'17'=>'17:00',
			'18'=>'17:30',
			'19'=>'18:00',
			'20'=>'18:30',
			'21'=>'19:00',
			'22'=>'19:30',
			'23'=>'20:00',
			'24'=>'20:30',
		);?>-->
        
        <!--  substr_replace('timevalue', 0, 4) -->
        <?php $list_time = CHtml::listData($times, 'idseg_starttimes', 'timevalue'); ?>
        <?php echo $form->dropDownList($model,'time_n',$list_time,array('empty'=>'Time')); ?>
    </div>               
                
    <!-- LANGUAGE -->
    <div class="row-filter"> 
     	<? $list_l =array('1'=>'german','2'=>'english');?>
		<!--<php $list_l = CHtml::listData($languages, 'id_languages', 'englishname'); ?>-->
		<?php echo $form->dropDownList($model,'language',$list_l, array('empty'=>'Language')); ?>
     </div>
                
	<!-- GUIDE -->    
  
    <div class="row-filter"> 
    	<?php $list_g = CHtml::listData($guides, 'idcontacts', 'firstname'); ?>
		<?php echo $form->dropDownList($model,'guide',$list_g,array('prompt'=>'Guide')); ?>
    </div>
                

   

           
            	<button class="but-filter" type="submit"><?php echo 'FIND TOUR'; ?></button>
        

<?php $this->endWidget(); ?>
  