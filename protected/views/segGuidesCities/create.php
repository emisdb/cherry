<?php
/* @var $this SegGuidesCitiesController */
/* @var $model SegGuidesCities */

$this->breadcrumbs=array(
	'Seg Guides Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegGuidesCities', 'url'=>array('index')),
	array('label'=>'Manage SegGuidesCities', 'url'=>array('admin')),
);
?>

<h1>Create SegGuidesCities</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>