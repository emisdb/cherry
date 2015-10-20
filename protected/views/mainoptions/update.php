<?php
/* @var $this MainoptionsController */
/* @var $model Mainoptions */

$this->breadcrumbs=array(
	'Mainoptions'=>array('admin'),
	'Update option',
);
?>

<h1>Update options <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>