<?php
/* @var $this SegTourroutesController */
/* @var $model SegTourroutes */

$this->breadcrumbs=array(
	'Seg Tourroutes'=>array('index'),
	$model->name=>array('view','id'=>$model->idseg_tourroutes),
	'Update',
);

$this->menu=array(
	array('label'=>'List SegTourroutes', 'url'=>array('index')),
	array('label'=>'Create SegTourroutes', 'url'=>array('create')),
	array('label'=>'View SegTourroutes', 'url'=>array('view', 'id'=>$model->idseg_tourroutes)),
	array('label'=>'Manage SegTourroutes', 'url'=>array('admin')),
);
?>

<h1>Update SegTourroutes <?php echo $model->idseg_tourroutes; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>