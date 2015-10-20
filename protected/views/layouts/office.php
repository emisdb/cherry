<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="de" />
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">

    <title><?php echo CHtml::encode(Yii::t('main','Control system - office')); ?></title>

    <?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adstyle.css" />

</head>

<body>
    <div class="container" style="background: #f0f0f0; border-radius: 5px;margin:10px auto;">
        <div class="row-fluid" style="margin: 20px 0;">
            <div class="span2" >
                <div style="padding:10px;">

                    <div style="color:#959899;font-size:16px;text-transform:uppercase;">OFFICE</div>
                    <hr />
                    <a href="<?php echo Yii::app()->request->baseUrl.'/user/profile'; ?>">Profile</a><br/>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/" target="_blank">Return to the site</a><br/>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/logout">Exit</a>
                    <hr />

                   <a href="<?php echo Yii::app()->request->baseUrl.'/user/admin'; ?>">Users</a><br/>
                   <a href="<?php echo Yii::app()->request->baseUrl.'/bonus/admin'; ?>">Discount</a><br/>
                   <a href="<?php echo Yii::app()->request->baseUrl.'/segScheduledTours/officeadmin'; ?>">Schedule</a><br/>

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

        <div class="row" style="margin: 20px 0;">
             <div class="span12">
                 <strong><a href = "http://dicapo.ru">© <?php echo date('Y'); ?> DICAPO.</a></strong>
             </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#some-textarea').wysihtml5();
    </script>

</body>
</html>

