<?php
/* @var $this CancellationReasonController */
/* @var $model CancellationReason */

$this->breadcrumbs=array(
	'Cancellation Reasons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CancellationReason', 'url'=>array('index')),
	array('label'=>'Manage CancellationReason', 'url'=>array('admin')),
);
?>

<h1>Create CancellationReason</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>