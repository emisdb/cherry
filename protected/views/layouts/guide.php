<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="de" />
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">

    <title><?php echo CHtml::encode(Yii::t('main','Control system - root')); ?></title>

    <?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adstyle.css" />

</head>

<body>
    <div class="container" style="background: #f0f0f0; border-radius: 5px;margin:10px auto;">
        <div class="row-fluid" style="margin: 20px 0;">
         	<div class="span3" >
                <div style="padding:10px;">
                    <div style="color:#959899;font-size:16px;text-transform:uppercase;">GIEDE</div>
                    <hr />
                    <a href="<?php echo Yii::app()->request->baseUrl.'/user/profile'; ?>">Profile</a><br/>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" target="_blank">Return to the site</a><br/>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/logout">Exit</a>
                    <hr />
                    
					<div>Calendar</div>
                    
                    <div style=" width:100px;">
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            'name'=>'publishDate',
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat' => 'dd.mm.yy',
                                 'yearRange'=>'2015:2050',
                                 'minDate' => 0,//'01.06.2015',//0, 
                                 'defaultDate'=> time(),     
                                 //'maxDate' => '2099-12-31',  
                                 'onSelect'=> 'js: function(date) {if(date != "") { 
                                    window.location.href = "'.CHtml::encode($this->createUrl('segScheduledTours/weeks'
                                    )).'/date/"+date ;
                                 } }',
                            ),
                            'htmlOptions'=>array(
                                 	'size' => '10',         // textField size
        							'maxlength' => '10', 
                            ),
                            'flat'=>false,
                        )); 
                    ?>
                    </div>

                    <hr>
                    <a href="<?php echo Yii::app()->request->baseUrl.'/segScheduledTours/spontan'; ?>">Spontaneous tour</a><br/>
                    <a href="<?php echo Yii::app()->request->baseUrl.'/segScheduledTours/admin'; ?>">Schedule</a><br/>
                    <a href="<?php echo Yii::app()->request->baseUrl.'/cashboxHistory/history/id/'.$id_control = Yii::app()->user->id; ?>">Kassa</a><br/>
                    
					<!--<a href="<php echo Yii::app()->request->baseUrl.'/pepletour/admin'; ?>">Accounting of funds</a><br/>-->
                    <!-- учет денежных средств -->

                    <div style="padding-top:350px;"></div>
                </div>
            </div>
            <div class="span9">

                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                    'homeLink'=>CHtml::link('Control system', $this->createUrl('/main/system')),
                    'htmlOptions'=>array(
                        'class' => 'breadcrumbs_admin'
                    ),
                )); ?>
                <div class="content_admin">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
        
        <div class="row-fluid" style="margin: 20px 0;">
             <div class="span12" style="padding: 0 20px;">
                 <strong><a href = "http://dicapo.ru">© <?php echo date('Y'); ?> DICAPO.</a></strong>
             </div>
        </div>
    </div>

</body>
</html>

