<?php
/* @var $this SegCitiesController */
/* @var $model SegCities */

$this->breadcrumbs=array(
	'Cities'=>array('admin'),
//	$model->idseg_cities=>array('view','id'=>$model->idseg_cities),
	'Update citie',
);

?>

<h1>Update Cities <?php echo $model->seg_cityname; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>