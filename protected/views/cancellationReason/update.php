<?php
/* @var $this CancellationReasonController */
/* @var $model CancellationReason */

$this->breadcrumbs=array(
	'Cancellation Reasons'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CancellationReason', 'url'=>array('index')),
	array('label'=>'Create CancellationReason', 'url'=>array('create')),
	array('label'=>'View CancellationReason', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CancellationReason', 'url'=>array('admin')),
);
?>

<h1>Update CancellationReason <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>