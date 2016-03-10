<?php $this->renderPartial('_top', array('info'=>$info)); ?>
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
	<?php
/* @var $this UsergroupsController */
/* @var $model Usergroups */

$this->breadcrumbs=array(
	//'Usergroups'=>array('index'),
	'Manage usergroups',
);

?>

<h1>Manage Usergroups</h1>

      </section>

        <!-- Main content -->
        <section class="content">


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usergroups-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'idusergroups',
		'groupname',
	//	array(
	//		'class'=>'CButtonColumn',
	//	),
	),
)); ?>
    </section><!-- /.content -->
      </div><!-- /.content-wrapper -->