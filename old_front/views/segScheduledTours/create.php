<?php
/* @var $this SegScheduledToursController */
/* @var $model SegScheduledTours */

$this->breadcrumbs=array(
	'Seg Scheduled Tours'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegScheduledTours', 'url'=>array('index')),
	array('label'=>'Manage SegScheduledTours', 'url'=>array('admin')),
);
?>

<h1>Create SegScheduledTours</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>