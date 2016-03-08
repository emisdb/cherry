<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
	<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'New record',
);
?>

<h1>New record USER</h1>
      </section>

        <!-- Main content -->
        <section class="content">

<?php $this->renderPartial('_form', array('model'=>$model,'usergroups'=>$usergroups)); ?>

    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->