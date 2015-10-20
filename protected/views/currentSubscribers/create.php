<?php
/* @var $this CurrentSubscribersController */
/* @var $model CurrentSubscribers */

$this->breadcrumbs=array(
	'Current Subscribers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CurrentSubscribers', 'url'=>array('index')),
	array('label'=>'Manage CurrentSubscribers', 'url'=>array('admin')),
);
?>

<h1>Create CurrentSubscribers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>