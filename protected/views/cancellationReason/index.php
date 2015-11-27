<?php
/* @var $this CancellationReasonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cancellation Reasons',
);

$this->menu=array(
	array('label'=>'Create CancellationReason', 'url'=>array('create')),
	array('label'=>'Manage CancellationReason', 'url'=>array('admin')),
);
?>

<h1>Cancellation Reasons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
