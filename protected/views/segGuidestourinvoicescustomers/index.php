<?php
/* @var $this SegGuidestourinvoicescustomersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Guidestourinvoicescustomers',
);

$this->menu=array(
	array('label'=>'Create SegGuidestourinvoicescustomers', 'url'=>array('create')),
	array('label'=>'Manage SegGuidestourinvoicescustomers', 'url'=>array('admin')),
);
?>

<h1>Seg Guidestourinvoicescustomers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
