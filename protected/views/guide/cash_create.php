<?php $this->renderPartial('_top', array('info'=>$info)); ?>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		  
		          <section class="content-header">
			<?php
/* @var $this CashboxChangeRequestsController */
/* @var $model CashboxChangeRequests */

$this->breadcrumbs=array(
	'Cashbox Change Requests'=>array('cash'),
	'Create',
);


$this->menu=array(
	array('label'=>'List Cashbox Records', 'url'=>array('cash')),
//	array('label'=>'Manage Cashbox Records', 'url'=>array('admin')),
);
?>

<h1>Create cashbox record</h1>
      </section>

        <!-- Main content -->
        <section class="content">

<?php
	$this->renderPartial('cash_form', array('model'=>$model)); 
	?>
     </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


