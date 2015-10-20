<?php
/* @var $this PepletourController */
/* @var $model Pepletour */

$this->breadcrumbs=array(
	'Pepletours'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pepletour', 'url'=>array('index')),
	array('label'=>'Manage Pepletour', 'url'=>array('admin')),
);
?>

<h1>Create Pepletour</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>