 <!--<form role="form" class="form-inline">
 <div class="form-group">
 
  
  <select class="form-control" placeholder="City">
 <option>1</option>
 <option>2</option>
 <option>3</option>
 <option>4</option>
 <option>5</option>
</select>
 </div>
 <div class="form-group">
<div class="input-group date">
  <input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
</div>
  <input type="password" class="form-control t-form" id="pass" placeholder="Date"><i class="icon-search"></i>
 </div>
  <div class="form-group">
 <button type="submit" class="btn ">FIND TOUR</button>
 </div>
</form>-->




<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-main',
	'enableAjaxValidation'=>false,
    'action'=>Yii::app()->createUrl('segScheduledTours/result'),
    'htmlOptions'=>array(
        'class'=>'form-inline',
    ),
    //'role'=>'form',
)); ?>

<!--	<php echo $form->errorSummary($model); ?>-->
    <!--
<div class="btn-group">
              <button data-toggle="dropdown" class="btn btn-default dropdown-toggle">Option1 <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li>
                  <input type="radio" id="ex1_1" name="ex1" value="1" checked>
                  <label for="ex1_1">Option1</label>
                </li>
                <li>
                  <input type="radio" id="ex1_2" name="ex1" value="2">
                  <label for="ex1_2">Option2</label>
                </li>
                <li>
                  <input type="radio" id="ex1_3" name="ex1" value="3">
                  <label for="ex1_3">Option3</label>
                </li>
                <li>
                  <input type="radio" id="ex1_4" name="ex1" value="4" disabled>
                  <label for="ex1_4">I'm disabled</label>
                </li>
              </ul>
            </div>

<div class="btn-group">
  <button data-toggle = "dropdown" class="btn btn-default dropdown-toggle"> <span data-label-placement>City</span>
  <span class="caret"></span>
  
  </button>

    <ul class="dropdown-menu">
      <li><input type="text" id="ID" name="NAME" value="VALUE"><label for="ID">Label</label></li>
       <li><input type="radio" id="ID" name="NAME" value="VALUE"><label for="ID">Label</label></li>
        <li><input type="radio" id="ID" name="NAME" value="VALUE"><label for="ID">Label</label></li>
 
    </ul>
</div>-->
      
      
       <!-- <select class="selectpicker">
    <option>Mustard</option>
    <option>Ketchup</option>
    <option>Relish</option>
  </select>-->
      

    <div class="form-group">

		<?php $list = CHtml::listData($citys, 'idseg_cities', 'seg_cityname'); ?>
		<?php echo $form->dropDownList($model,'city',$list,array('empty' => '', 'class'=>'form-control111 ')); ?>


      

	</div>

<div class="form-group">
	
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'attribute' => 'date',
            'model' => $model,
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat' => 'dd.mm.yy',
                'yearRange' => '1950:2015',
                'changeMonth' => true,
                'changeYear' => true,
                // 'minDate' => '01.06.2015',//0, 
                // 'defaultDate'=> time(),     
                 //'maxDate' => '2099-12-31',  
                // 'onSelect'=> 'js: function(date) {if(date != "") { 
                //    window.location.href = "'.CHtml::encode($this->createUrl('segScheduledtours/weeks'
                //    )).'/date/"+date ;
                // } }',
            ),
            'htmlOptions'=>array(
                'class'=>'form-control'
            ),
            //'flat'=>true,
        )); ?>
       

	</div>


	<div class="form-group buttons">
        <button class="btn-sub " type="submit"><?php echo 'FIND TOUR'; ?></button>
       
        
    </div>
<?php $this->endWidget(); ?>



<!-- *************************************************-->
    
  <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-main',
	'enableAjaxValidation'=>false,
    'action'=>Yii::app()->createUrl('segScheduledTours/result'),
    'htmlOptions'=>array(
        'class'=>'form-inline',
    ),
    //'role'=>'form',
)); ?>
  
  
  
  
    <div class="form-group">

		<?php $list = CHtml::listData($citys, 'idseg_cities', 'seg_cityname'); ?>
		<?php echo $form->dropDownList($model,'city',$list,array('empty'=>'City','class'=>'form-control-new1 selectpicker')); ?>

	</div>
  
  
<div class="form-group">
	
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'attribute' => 'date',
            'model' => $model,
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat' => 'dd.mm.yy',
                'yearRange' => '1950:2015',
                'changeMonth' => true,
                'changeYear' => true,
                // 'minDate' => '01.06.2015',//0, 
                // 'defaultDate'=> time(),     
                 //'maxDate' => '2099-12-31',  
                // 'onSelect'=> 'js: function(date) {if(date != "") { 
                //    window.location.href = "'.CHtml::encode($this->createUrl('segScheduledtours/weeks'
                //    )).'/date/"+date ;
                // } }',
            ),
            'htmlOptions'=>array(
                'class'=>'form-control'
            ),
            //'flat'=>true,
        )); ?>
       

	</div>


	<div class="form-group buttons">
        <button class="btn-sub " type="submit"><?php echo 'FIND TOUR'; ?></button>
       
        
    </div>
<?php $this->endWidget(); ?>