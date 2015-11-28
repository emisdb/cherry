<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Cancellation Reasons "<?php echo $model->name; ?>" </h1>
     </section>

        <!-- Main content -->
        <section class="content">
			<?php $this->renderPartial('_form_cr', array('model'=>$model)); ?>
		</section><!-- /.content -->
	 </div><!-- /.content-wrapper -->