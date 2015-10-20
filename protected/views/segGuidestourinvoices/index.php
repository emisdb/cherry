<?php
/* @var $this SegGuidestourinvoicesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Guidestourinvoices',
);

$this->menu=array(
	array('label'=>'Create SegGuidestourinvoices', 'url'=>array('create')),
	array('label'=>'Manage SegGuidestourinvoices', 'url'=>array('admin')),
);
?>

<h1>Seg Guidestourinvoices</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
