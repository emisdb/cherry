
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">Guide</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Guide</b> desk</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-calendar-o"></i>
                  <span class="label label-warning"><?php echo count($info['tours'])?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo count($info['tours'])?> tours scheduled</li>
                  <li>
                   <ul class="menu">
                   <!-- inner menu: contains the actual data -->
					  <?php
						foreach ($info['tours'] as $key => $value) {
							$date_format=date_format(new DateTime($value->date),'d.m.Y');
						  echo '<li>'.CHtml::link(CHtml::encode(''.($key+1).'. '.$date_format.' '.$value->starttime), array('segScheduledTours/weeks','date'=>$date_format));
						  echo "</li>\n";
					  }
					  ?>
                     </ul>
                  </li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-file-o"></i>
                  <span class="label label-danger"><?php echo count($info['todo'])?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo count($info['todo'])?> tours unreported</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
 					  <?php
						foreach ($info['todo'] as $key => $value) {
							$date_format=date_format(new DateTime($value->date),'d.m.Y');
						  echo '<li>'.CHtml::link(CHtml::encode(''.($key+1).'. '.$date_format.' '.$value->starttime), array('segGuidestourinvoicescustomers/current','id_sched'=>$value->idseg_scheduled_tours));
//						  echo '<li>'.CHtml::link(CHtml::encode(''.($key+1).'. '.$date_format.' '.$value->starttime), array('segGuidestourinvoicescustomers/current','id_sched'=>$value->idseg_scheduled_tours,'date'=>$date_format,'time'=>$value->starttime));
						  //segGuidestourinvoicescustomers/current/id_sched/405/date/2015-10-20/time/18:00:00
						  echo "</li>\n";
					  }
					  ?>
                    </ul>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo Yii::app()->request->baseUrl."/image/guide/".$info['guide']['data']->lnk_to_picture ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $info['guide']['contact']->firstname." ".$info['guide']['contact']->surname ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo Yii::app()->request->baseUrl."/image/guide/".$info['guide']['data']->lnk_to_picture ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $info['guide']['contact']->firstname." ".$info['guide']['contact']->surname ?>
                      <small><?php echo $info['guide']['contact']->email ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-6 text-center">
                      <a href="#"><?php echo $info['guide']['contact']->country ?></a>
                    </div>
                    <div class="col-xs-6 text-center">
                      <a href="#"><?php echo $info['guide']['contact']->city ?></a>
                    </div>
                            </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
						<?php echo CHtml::link("Profile", array('user/profile'),array('class'=>'btn btn-default btn-flat')); ?>
                   </div>
                    <div class="pull-right">
						<?php echo CHtml::link("Sign out", array('site/logout'),array('class'=>'btn btn-default btn-flat')); ?>
                     </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
 
        </section>

        <!-- Main content -->
        <section class="content">
		        <div class="content_admin">
					result:
					<?php 
					foreach ($info as $key => $value) {
					echo "<hr/>";
					echo "$key.".count($value);
					echo "<hr/>";
					foreach ($value as $keyy => $val) {
					echo "<hr/>";
					echo "$key.".count($val);
					echo "<hr/>";
					var_dump($val);
					}

				} ?>  
				</div>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
             </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
             </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
             </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


