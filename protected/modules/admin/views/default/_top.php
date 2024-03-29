	<header class="main-header">
        <!-- Logo -->
 		<?php echo CHtml::link('<span class="logo-mini">Office</span><span class="logo-lg"><b>Office</b> desk</span>', array('admin'),array('class'=>'logo')); ?>
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
                <ul class="dropdown-menu" style="background-color: #8fdf82;">
                  <li class="header" style="background-color: #8fdf82;" >Sie haben <?php echo count($info['tours'])?> Kasse Aufzeichnungen zu genehmigen</li>
                  <li>
                   <ul class="menu">
                   <!-- inner menu: contains the actual data -->
					  <?php
						foreach ($info['tours'] as $key => $value) {
							$date_format=date_format(new DateTime($value->request_date),'d.m.Y');
						  echo '<li>'.CHtml::link(CHtml::encode(''.($key+1).'. '.$date_format.' '.$value->user['username']).': '.number_format($value->delta_cash, 2, '.', ' '), array('cashrecord','id'=>$value->idcashbox_change_requests));
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
                <ul class="dropdown-menu" style="background-color: #8fdf82;">
                  <li class="header" style="background-color: #8fdf82;">Sie haben <?php echo count($info['todo'])?> Touren nicht gemeldet</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
 					  <?php
						foreach ($info['todo'] as $key => $value) {
							$date_format=date_format(new DateTime($value->date),'d.m.Y');
						  echo '<li>'.CHtml::link(CHtml::encode(''.($key+1).'. '.$date_format.' '.Yii::app()->dateFormatter->format('HH:mm',strtotime($value->starttime))), array('current','id_sched'=>$value->idseg_scheduled_tours));
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
                  <img src="<?php echo Yii::app()->request->baseUrl."/img/cherrytours_icon_colour_rgb.jpg" ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $info['guide']->firstname." ".$info['guide']->surname ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo Yii::app()->request->baseUrl."/img/cherrytours_icon_colour_rgb.jpg" ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $info['guide']->firstname." ".$info['guide']->surname ?>
                      <small><?php echo $info['guide']->email ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-6 text-center">
                 	<?php echo CHtml::link("Gesamt:", array('cashAdmin')); ?>
                   </div>
                   <div class="col-xs-6 text-center">
                   	<?php echo CHtml::link(CHtml::encode("".number_format($this->cashsum, 2, '.', ' ').""), array('cashAdmin')); ?>
					   &euro;
                    </div>
                   </li>
                    <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
						<?php echo CHtml::link("Benutzer", array('profile'),array('class'=>'btn btn-default btn-flat')); ?>
                   </div>
                    <div class="pull-right">
						<?php echo CHtml::link("Ausloggen", array('site/logout'),array('class'=>'btn btn-default btn-flat')); ?>
                     </div>
                  </li>
                </ul>
              </li>
             </ul>
          </div>
        </nav>
      </header>