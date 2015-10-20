
<div class="form-search-x">
    <div class="form-search-background"></div>
</div>

<div class="form-search-x">
 	<div class="form-search">
		<?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-form',
            'enableAjaxValidation'=>false,
            'action'=>Yii::app()->createUrl('segScheduledTours/result'),
            'htmlOptions'=>array(
                'class'=>'form-main'
            ),
        )); ?>
        
            <div class="row-form">
                    <div class="span-7">
                        <!--<php $list = CHtml::listData($citys, 'idseg_cities', 'seg_cityname'); ?>-->
                        <? $list = array('1' => 'Berlin','2' => 'München'); ?>
                        
                        <?php echo $form->dropDownList($model,'city',$list,array(  'class'=>'form-control-city', 'empty'=>'City')); ?>
                    </div>
        
                    <div class="span-7">
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                             'model' => $model,
                             'attribute' => 'date',
                             'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat' => 'dd.mm.yy',
                                'yearRange' => '2015:2020',
                                'minDate' => 0, 
                                'dateonly' => true,  
                             ),
                             'htmlOptions'=>array(
                                'class'=>'form-control-date',
                                'placeholder'=>'Date',
                            ),
                            'language'=>'en',
                        )); ?>
                    </div>
        
                    <div class="span-7">
                        <button class="btn-sub " type="submit"><?php echo 'FIND TOUR'; ?></button>
                    </div>
             </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
  