<?php
/* @var $this CashboxTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cashbox Types',
);

$this->menu=array(
	array('label'=>'Create CashboxType', 'url'=>array('create')),
	array('label'=>'Manage CashboxType', 'url'=>array('admin')),
);
?>

<h1>Cashbox Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
