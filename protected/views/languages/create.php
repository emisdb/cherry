<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('admin'),
	'New record languages',
);

?>

<h1>New record Languages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>