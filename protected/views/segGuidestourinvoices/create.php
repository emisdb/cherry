<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $model SegGuidestourinvoices */

$this->breadcrumbs=array(
	'Seg Guidestourinvoices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoices', 'url'=>array('index')),
	array('label'=>'Manage SegGuidestourinvoices', 'url'=>array('admin')),
);
?>

<h1>Create SegGuidestourinvoices</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>