<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $model SegGuidestourinvoicescustomers */

$this->breadcrumbs=array(
	'Seg Guidestourinvoicescustomers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoicescustomers', 'url'=>array('index')),
	array('label'=>'Manage SegGuidestourinvoicescustomers', 'url'=>array('admin')),
);
?>

<h1>Create SegGuidestourinvoicescustomers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>