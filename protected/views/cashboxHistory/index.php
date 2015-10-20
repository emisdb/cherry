<?php
/* @var $this CashboxHistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cashbox Histories',
);

$this->menu=array(
	array('label'=>'Create CashboxHistory', 'url'=>array('create')),
	array('label'=>'Manage CashboxHistory', 'url'=>array('admin')),
);
?>

<h1>Cashbox Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
