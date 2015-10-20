<?php
/* @var $this UsergroupsController */
/* @var $model Usergroups */

$this->breadcrumbs=array(
	//'Usergroups'=>array('index'),
	'Manage usergroups',
);

?>

<h1>Manage Usergroups</h1>



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
