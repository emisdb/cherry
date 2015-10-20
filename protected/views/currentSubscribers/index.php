<?php
/* @var $this CurrentSubscribersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Current Subscribers',
);

$this->menu=array(
	array('label'=>'Create CurrentSubscribers', 'url'=>array('create')),
	array('label'=>'Manage CurrentSubscribers', 'url'=>array('admin')),
);
?>

<h1>Current Subscribers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
