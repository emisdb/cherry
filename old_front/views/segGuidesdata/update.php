<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */

$this->breadcrumbs=array(
	'Seg Guidesdatas'=>array('index'),
	$model->idseg_guidesdata=>array('view','id'=>$model->idseg_guidesdata),
	'Update',
);

$this->menu=array(
	array('label'=>'List SegGuidesdata', 'url'=>array('index')),
	array('label'=>'Create SegGuidesdata', 'url'=>array('create')),
	array('label'=>'View SegGuidesdata', 'url'=>array('view', 'id'=>$model->idseg_guidesdata)),
	array('label'=>'Manage SegGuidesdata', 'url'=>array('admin')),
);
?>

<h1>Update SegGuidesdata <?php echo $model->idseg_guidesdata; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>