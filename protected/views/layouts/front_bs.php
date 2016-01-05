<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="de" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">

    <title><?php echo CHtml::encode(Yii::t('main','Control system - root')); ?></title>
     <?php // Yii::app()->bootstrap->register(); ?>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adstyle.css" />
 	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
   <!--<script src="<?php // echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/plugins/chartjs/Chart.min.js" type="text/javascript"></script>-->
 
</head>

  <body>
    <div class="container">
      <!-- Left side column. contains the logo and sidebar -->
        <?php echo $content; ?>
         <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015 <a href="http://cherrytours.com">Cherry Tours</a>.</strong> All rights reserved.
      </footer>

     </div><!-- ./wrapper -->

</body>
</html>

