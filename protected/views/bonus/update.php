<?php

$this->breadcrumbs=array(
	'Discount'=>array('admin'),
	'Update',
);
?>

<h1>Discount "<?php echo $model->name; ?> <?php echo $model->type; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>