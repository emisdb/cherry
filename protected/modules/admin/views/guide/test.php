<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<!-- Modal -->

       <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>Current Test</h1>
			<ol class="breadcrumb">
				<li>
					<?php echo Chtml::link('Scheduled Tours',array('guide/schedule')); ?>
				</li>
				<li class="active"> Current Subscriber
				</li>
			</ol>	
		</section>

        <!-- Main content -->
        <section class="content">

<?php var_dump($model); ?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


