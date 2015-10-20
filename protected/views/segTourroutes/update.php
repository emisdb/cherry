<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'All Tourroutes'=>array('admin'),
	'Update tourroute',
);

?>

<h1>Update Tourroute <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>