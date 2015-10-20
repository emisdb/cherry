<?php
/* @var $this SegGuidesTourroutesController */
/* @var $model SegGuidesTourroutes */

$this->breadcrumbs=array(
	'Seg Guides Tourroutes'=>array('index'),
	$model->idseg_guides_tourroutes,
);

$this->menu=array(
	array('label'=>'List SegGuidesTourroutes', 'url'=>array('index')),
	array('label'=>'Create SegGuidesTourroutes', 'url'=>array('create')),
	array('label'=>'Update SegGuidesTourroutes', 'url'=>array('update', 'id'=>$model->idseg_guides_tourroutes)),
	array('label'=>'Delete SegGuidesTourroutes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_guides_tourroutes),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegGuidesTourroutes', 'url'=>array('admin')),
);
?>

<h1>View SegGuidesTourroutes #<?php echo $model->idseg_guides_tourroutes; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_guides_tourroutes',
		'usersid',
		'tourroutes_id',
	),
)); ?>
