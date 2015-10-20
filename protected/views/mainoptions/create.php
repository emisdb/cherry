<?php
/* @var $this MainoptionsController */
/* @var $model Mainoptions */

$this->breadcrumbs=array(
	'Main options'=>array('admin'),
	'New option',
);
?>

<h1>New option</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>