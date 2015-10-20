<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $model SegGuidestourinvoices */

$this->breadcrumbs=array(
	'Seg Guidestourinvoices'=>array('index'),
	$model->idseg_guidesTourInvoices=>array('view','id'=>$model->idseg_guidesTourInvoices),
	'Update',
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoices', 'url'=>array('index')),
	array('label'=>'Create SegGuidestourinvoices', 'url'=>array('create')),
	array('label'=>'View SegGuidestourinvoices', 'url'=>array('view', 'id'=>$model->idseg_guidesTourInvoices)),
	array('label'=>'Manage SegGuidestourinvoices', 'url'=>array('admin')),
);
?>

<h1>Update SegGuidestourinvoices <?php echo $model->idseg_guidesTourInvoices; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>