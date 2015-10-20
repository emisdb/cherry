<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'All Tourroutes'=>array('admin'),
	'New tourroute',
);

?>

<h1>New tourroute</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>