<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="de" />
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/fav.ico" type="image/x-icon">

    <title><?php echo CHtml::encode(Yii::t('main','Control system - root')); ?></title>
     <?php // Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/adstyle.css" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 <!--   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
<!-- 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
	 <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <!--<script src="<?php // echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/plugins/chartjs/Chart.min.js" type="text/javascript"></script>-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/dist/js/app.min.js" type="text/javascript"></script>

</head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
           <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
             <li>
				<?php echo CHtml::link("<i class='fa fa-th'></i> <span>Profile</span>", array('profile')); ?>
            </li>
             <li>
				<?php echo CHtml::link("<i class='fa fa-laptop'></i> <span>Return to the site</span>", "/"); ?>
            </li>
              <li>
				<?php echo CHtml::link("<i class='fa fa-table'></i><span>Schedule</span>", array('guide/weeks','date'=>date('d.m.Y'))); ?>
            </li>
               <li>
				<?php echo CHtml::link("<i class='fa fa-edit'></i> <span>Scheduled tours</span>", array('guide/schedule')); ?>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Cashbox</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
					<?php echo CHtml::link("<i class='fa fa-money'></i> <span>Cashbox history (old)</span>", array('guide/history','id'=> Yii::app()->user->id)); ?>
				</li>
                <li>
					<?php echo CHtml::link("<i class='fa fa-credit-card'></i> <span>Cashbox history</span>", array('guide/cash')); ?>
				</li>
                <li>
					<?php echo CHtml::link("<i class='fa fa-money'></i> <span>Create record</span>", array('guide/createCash')); ?>
				</li>
              </ul>
            </li>

            </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

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
