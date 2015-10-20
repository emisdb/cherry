<?php
/* @var $this SegLanguagesGuidesController */
/* @var $model SegLanguagesGuides */

$this->breadcrumbs=array(
	'Seg Languages Guides'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegLanguagesGuides', 'url'=>array('index')),
	array('label'=>'Manage SegLanguagesGuides', 'url'=>array('admin')),
);
?>

<h1>Create SegLanguagesGuides</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>