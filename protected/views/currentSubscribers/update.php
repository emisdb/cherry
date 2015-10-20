<?php
/* @var $this CurrentSubscribersController */
/* @var $model CurrentSubscribers */

$this->breadcrumbs=array(
	'Current Subscribers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CurrentSubscribers', 'url'=>array('index')),
	array('label'=>'Create CurrentSubscribers', 'url'=>array('create')),
	array('label'=>'View CurrentSubscribers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CurrentSubscribers', 'url'=>array('admin')),
);
?>

<h1>Update CurrentSubscribers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>