	<header class="main-header">
        <!-- Logo -->
 		<?php echo CHtml::link('<span class="logo-mini">Root</span><span class="logo-lg"><b>Root</b> desk</span>', array('admin'),array('class'=>'logo')); ?>
         <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
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
						<?php echo CHtml::link("Ausloggen", array('default/logout'),array('class'=>'btn btn-default btn-flat')); ?>
                     </div>
                  </li>
                </ul>
              </li>
             </ul>
          </div>
        </nav>
      </header>