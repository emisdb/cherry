<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'Seg Tourroutes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegTourroutes', 'url'=>array('index')),
	array('label'=>'Manage SegTourroutes', 'url'=>array('admin')),
);
?>

<h1>Create SegTourroutes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>