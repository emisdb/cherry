<?php
/* @var $this SegContactsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Contacts',
);

$this->menu=array(
	array('label'=>'Create SegContacts', 'url'=>array('create')),
	array('label'=>'Manage SegContacts', 'url'=>array('admin')),
);
?>

<h1>Seg Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
