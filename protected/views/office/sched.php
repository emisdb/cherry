<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<h1>Update ScheduledTours <?php echo $model->idseg_scheduled_tours; ?></h1>
     </section>

        <!-- Main content -->
        <section class="content">

<?php $this->renderPartial('_form_schedo',
		array('model'=>$model, 
			'tours_guide'=>$tours_guide,
			'languages_guide'=>$languages_guide,
			'guide_list'=>$guide_list)); ?>
		</section><!-- /.content -->
      </div><!-- /.content-wrapper -->

