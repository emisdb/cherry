<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $model SegGuidestourinvoicescustomers */

$this->breadcrumbs=array(
	'Seg Guidestourinvoicescustomers'=>array('index'),
	$model->idseg_guidesTourInvoicesCustomers=>array('view','id'=>$model->idseg_guidesTourInvoicesCustomers),
	'Update',
);

$this->menu=array(
	array('label'=>'List SegGuidestourinvoicescustomers', 'url'=>array('index')),
	array('label'=>'Create SegGuidestourinvoicescustomers', 'url'=>array('create')),
	array('label'=>'View SegGuidestourinvoicescustomers', 'url'=>array('view', 'id'=>$model->idseg_guidesTourInvoicesCustomers)),
	array('label'=>'Manage SegGuidestourinvoicescustomers', 'url'=>array('admin')),
);
?>

<h1>Update SegGuidestourinvoicescustomers <?php echo $model->idseg_guidesTourInvoicesCustomers; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>