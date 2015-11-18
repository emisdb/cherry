<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Seg Scheduled Tours'=>array('index'),
	$model->idseg_scheduled_tours=>array('view','id'=>$model->idseg_scheduled_tours),
	'Update',
);

$this->menu=array(
	array('label'=>'List SegScheduledTours', 'url'=>array('index')),
	array('label'=>'Create SegScheduledTours', 'url'=>array('create')),
	array('label'=>'View SegScheduledTours', 'url'=>array('view', 'id'=>$model->idseg_scheduled_tours)),
	array('label'=>'Manage SegScheduledTours', 'url'=>array('admin')),
);
?>

<h1>Update SegScheduledTours <?php echo $model->idseg_scheduled_tours; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>