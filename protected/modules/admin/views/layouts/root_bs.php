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
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/dist/css/skins/skin-purple.min.css" rel="stylesheet" type="text/css" />
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
   <!--<script src="<?php // echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/plugins/chartjs/Chart.min.js" type="text/javascript"></script>-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/AdminLTE/dist/js/app.min.js" type="text/javascript"></script>

</head>

  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height:auto;">
          <!-- Sidebar user panel -->
		  <div class="user-panel" style="color:#fff;">
			  
		  </div>
           <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
             <li <?php echo (Yii::app()->controller->action->id=='profile') ? "class=\"active\"" : "" ; ?>>
				<?php echo CHtml::link("<i class='fa fa-th'></i> <span>Benutzer</span>", array('profile')); ?>
            </li>
             <li>
				<?php echo CHtml::link("<i class='fa fa-laptop'></i> <span>Homepage</span>", "/"); ?>
            </li>
             <li <?php echo (Yii::app()->controller->action->id=='uadmin') ? "class=\"active\"" : "" ; ?>>
				<?php echo CHtml::link("<i class='fa fa-user'></i><span>Users</span>", array('uadmin')); ?>
            </li>
            <li <?php echo (Yii::app()->controller->action->id=='tadmin') ? "class=\"active\"" : "" ; ?>>
				<?php echo CHtml::link("<i class='fa fa-credit-card'></i><span>Tours</span>", array('tadmin')); ?>
            </li>
   			<li class="treeview <?php echo (in_array(Yii::app()->controller->action->id,array('ugadmin','ladmin','lcreate','lupdate'))) ? "active" : "" ; ?>">
              <a href="#">
                <i class="fa fa-list"></i>
                <span>REFERENCE</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
            <li <?php echo (Yii::app()->controller->action->id=='ugadmin') ? "class=\"active\"" : "" ; ?>>
				<?php echo CHtml::link("<i class='fa fa-chevron-down'></i><span>User Group</span>", array('ugadmin')); ?>
            </li>
             <li <?php echo (in_array(Yii::app()->controller->action->id,array('ladmin','lcreate','lupdate'))) ? "class=\"active\"" : "" ; ?>>
				<?php echo CHtml::link("<i class='fa fa-sign-out'></i><span>Languages</span>", array('ladmin')); ?>
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
        <strong>Copyright &copy; 2015 <a href="http://cherrytours.com">Cherrytours GmbH</a>.</strong> All rights reserved.
      </footer>

     </div><!-- ./wrapper -->

</body>
</html>

