<?php
/* @var $this SegGuidesTourroutesController */
/* @var $model SegGuidesTourroutes */

$this->breadcrumbs=array(
	'Seg Guides Tourroutes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegGuidesTourroutes', 'url'=>array('index')),
	array('label'=>'Manage SegGuidesTourroutes', 'url'=>array('admin')),
);
?>

<h1>Create SegGuidesTourroutes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>