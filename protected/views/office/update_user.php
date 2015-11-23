<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Update user - <?php echo $model->username; ?> (<?php echo $model->role_ob->groupname; ?> )</h1>
     </section>

        <!-- Main content -->
        <section class="content">
<?php $this->renderPartial('_form_user', array('model'=>$model)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->
