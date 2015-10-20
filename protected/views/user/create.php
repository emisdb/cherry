<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	'New record',
);
?>

<h1>New record USER</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'usergroups'=>$usergroups)); ?>