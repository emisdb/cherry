<?php
/* @var $this PepletourController */
/* @var $model Pepletour */

$this->breadcrumbs=array(
	'Pepletours'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pepletour', 'url'=>array('index')),
	array('label'=>'Create Pepletour', 'url'=>array('create')),
	array('label'=>'View Pepletour', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pepletour', 'url'=>array('admin')),
);
?>

<h1>Update Pepletour <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>