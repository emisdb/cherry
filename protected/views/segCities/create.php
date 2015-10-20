<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */

$this->breadcrumbs=array(
	'Cities'=>array('admin'),
	'New citie',
);

?>

<h1>New Citie</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>