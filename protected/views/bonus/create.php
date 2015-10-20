<?php
$this->breadcrumbs=array(
	'Discount'=>array('admin'),
	'New record',
);

?>

<h1>New record</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>