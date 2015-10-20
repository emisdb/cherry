<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
   // 'enableClientValidation' => true,
  //  'clientOptions' => array(
 //       'validateOnSubmit' => true,
 //       'validateOnChange' => true,
 //   ),
    'action'=>Yii::app()->createUrl('segScheduledTours/result'),
	'htmlOptions'=>array(
		'class'=>'form-main'
	),
)); ?>

<!--<form action="<php echo Yii::app()->createUrl('segScheduledTours/result');?>" method="post" class="form-main">-->
<style>
/*option:first-child{display:none;}*/

</style>
	<div class="row-form">
            <div class="span-3">
            
            
          <?php $list = CHtml::listData($citys, 'idseg_cities', 'seg_cityname'); ?>
			<?php echo $form->dropDownList($model,'city',$list,array(  'class'=>'draft', 'empty'=>'City')); ?>
            <!--selected disabled-->
           
              <!-- <php foreach($citys as $city){?> -->
                  <!--  <option value='<php echo $city->idseg_cities;?>' ><php echo $city->seg_cityname;?></option>-->
                      <!--<select name="city" class="" > 
                      <option   value="0" >City</option>
                     <option value='1' >Berlin</option>
                      <option value='2' >Munich</option>
                         </select>-->
                <!--<php }?>-->
                
               <!-- <option class="cred" value="1" selected >City1</option>
                <option class="cgreen" value="2" >City2</option>
                <option class="cccc" value="3" >City3</option>
                <option value="4" >City4</option>
                -->
       
                
                
                
                
        <!--        <php echo $form->dropDownList($contact,'tour',$list, array('options' => array($cat_item=>array('selected'=>true)))); ?>-->
                
            </div>

            <div class="span-3">
                <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                   // 'name' => 'date',
                     'model' => $model,
                      'attribute' => 'date',
					// additional javascript options for the date picker plugin
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
			
                 
                    'htmlOptions'=>array(
                        'class'=>'form-control',
						 // 'label'=>'Date',
						 'placeholder'=>'Date',
						 
                    ),
                    //'flat'=>true,
					
					'language'=>'en',
 
                        /*'options'=>array(
                            'showAnim'=>'fade',
							'dateFormat' => 'dd.mm.yy',
							 'yearRange' => '2015:2020',
							     'minDate' => 0, 
								    'defaultDate'=> time(),   
                            //'showOn'=>'button',
                            'buttonImageOnly'=>true,
                            'changeMonth'=>true,
                            'changeYear'=>true,
                            'showButtonPanel'=>true,
                            'showOtherMonths'=>true,
                        ),
					*/
					
                )); ?>
                
                
                
                
            </div>

            <div class="span-3">
            	<button class="btn-sub " type="submit"><?php echo 'FIND TOUR'; ?></button>
            </div>
     </div>
<?php $this->endWidget(); ?>
  