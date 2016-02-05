      <header class="main-header">
        <!-- Logo -->
 		<?php echo CHtml::link('<span class="logo-mini">Guide</span><span class="logo-lg"><b>Guide</b> desk</span>', array('schedule'),array('class'=>'logo')); ?>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
			  <li>
				  <?php echo CHtml::link($info['guide']['tel'], "tel:".$info['guide']['tel'])?>
			  </li>
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-calendar-o"></i>
                  <span class="label label-warning"><?php echo count($info['tours'])?></span>
                </a>
                <ul class="dropdown-menu" style="background-color: #80CFFF;">
                  <li class="header" style="background-color: #80CFFF;" >You have <?php echo count($info['tours'])?> tours scheduled</li>
                  <li>
                   <ul class="menu">
                   <!-- inner menu: contains the actual data -->
					  <?php
						foreach ($info['tours'] as $key => $value) {
							$date_format=date_format(new DateTime($value->date),'d.m.Y');
						  echo '<li>'.CHtml::link(CHtml::encode(''.($key+1).'. '.$date_format.' '.Yii::app()->dateFormatter->format('HH:mm',strtotime($value->starttime))), array('guide/show','id'=>$value->idseg_scheduled_tours));
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
                <ul class="dropdown-menu" style="background-color: #80CFFF;">
                  <li class="header" style="background-color: #80CFFF;">You have <?php echo count($info['todo'])?> tours unreported</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
 					  <?php
						foreach ($info['todo'] as $key => $value) {
							$date_format=date_format(new DateTime($value->date),'d.m.Y');
						  echo '<li>'.CHtml::link(CHtml::encode(''.($key+1).'. '.$date_format.' '.Yii::app()->dateFormatter->format('HH:mm',strtotime($value->starttime))), array('guide/current','id_sched'=>$value->idseg_scheduled_tours));
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
                      <small><?php echo $info['guide']['contact']->city ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-6 text-center">
                 	<?php echo CHtml::link("Cashbox:", array('cashReport')); ?>
                   </div>
                   <div class="col-xs-6 text-center">
                   	<?php echo CHtml::link(CHtml::encode("".number_format($this->cashsum, 2, '.', ' ').""), array('cashReport')); ?>
					   &euro;
                    </div>
                            </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
						<?php echo CHtml::link("Profile", array('guide/profile'),array('class'=>'btn btn-default btn-flat')); ?>
                   </div>
                    <div class="pull-right">
						<?php echo CHtml::link("Sign out", array('site/logout'),array('class'=>'btn btn-default btn-flat')); ?>
                     </div>
                  </li>
                </ul>
              </li>
             </ul>
          </div>
        </nav>
      </header>
 