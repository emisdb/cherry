<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */

$this->breadcrumbs=array(
	'Seg Guidesdatas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegGuidesdata', 'url'=>array('index')),
	array('label'=>'Manage SegGuidesdata', 'url'=>array('admin')),
);
?>

<h1>Create SegGuidesdata</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>