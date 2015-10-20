<?php
/* @var $this SegStarttimesController */
/* @var $model SegStarttimes */

$this->breadcrumbs=array(
	'Start times'=>array('admin'),
	'Update',
);

?>

<h1>Update Start times - <?php echo $model->timevalue; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>