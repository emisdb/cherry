<?php
/* @var $this LanguagesController */
/* @var $model Languages */

$this->breadcrumbs=array(
	'Languages'=>array('admin'),
	'Update language',
);


?>

<h1>Update Languages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>