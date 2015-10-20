<?php
/* @var $this PepletourController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pepletours',
);

$this->menu=array(
	array('label'=>'Create Pepletour', 'url'=>array('create')),
	array('label'=>'Manage Pepletour', 'url'=>array('admin')),
);
?>

<h1>Pepletours</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
