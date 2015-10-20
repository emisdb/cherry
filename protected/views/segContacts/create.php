<?php
/* @var $this SegContactsController */
/* @var $model SegContacts */

$this->breadcrumbs=array(
	'Seg Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SegContacts', 'url'=>array('index')),
	array('label'=>'Manage SegContacts', 'url'=>array('admin')),
);
?>

<h1>Create SegContacts</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>