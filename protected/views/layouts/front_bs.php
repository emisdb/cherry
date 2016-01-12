<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="de" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">

    <title><?php echo CHtml::encode(Yii::t('main','Cherrytours')); ?></title>
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
			 <div class="row">
			 <?php
				$select_lang=0;
				echo '<div class="col-md-2 col-md-offset-1">'.CHtml::link("&Uuml;ber Uns",array("main/about"))."</div>";
				echo '<div class="col-md-1">'.CHtml::link("Presse",array("main/about"))."</div>";
				echo '<div class="col-md-3">'.CHtml::link("AGB’s und Datenschut",array("main/about"))."</div>";
				echo '<div class="col-md-2">'.CHtml::link("Kontakt",array("main/about"))."</div>";
				echo '<div class="col-md-2">'.CHtml::dropDownList('sitelanguage', $select_lang, 
              array(0 => 'Deutch', 1 => 'English'),array('style'=>"border:0; padding:10px;")).'</div><div class="col-md-1"></div>';
			 ?>
			 </div>
			 <div class="row">
			<?php
				echo	CHtml::image(Yii::app()->request->baseUrl.'/img/logo_grey.png','info',array('style'=>'height: 50px; margin-top:50px;'));
			?>
			 </div>
			<div style="width:100%; margin-bottom:30px; font-size:1.7em; font-weight:bold; letter-spacing: 5px; text-transform: uppercase; text-align: center;" >CHERRYTOURS</div>
			<hr>
			<div style="padding-bottom:30px;">
			<?php
				echo	CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/img/facebook.png','info',array('style'=>'height: 50px; margin-top:50px;')),"http://facebook.com");
				echo	CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/img/twitter.png','info',array('style'=>'height: 50px; margin-top:50px;')),"http://twitter.com");
				echo	CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/img/camera.png','info',array('style'=>'height: 50px; margin-top:50px;')),"http://instagram.com");
			?>

		 </div>
      </footer>

     </div><!-- ./wrapper -->

</body>
</html>

