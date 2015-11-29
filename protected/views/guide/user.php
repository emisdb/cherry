<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<h1>Update user - <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>



<hr />	

       </section>

        <!-- Main content -->
        <section class="content">


<?php $this->renderPartial('_form_user', array('model'=>$model/*,'usergroups'=>$usergroups*/)); ?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
