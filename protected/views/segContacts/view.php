<?php
/* @var $this SegContactsController */
/* @var $model SegContacts */

$this->breadcrumbs=array(
	'Seg Contacts'=>array('index'),
	$model->idcontacts,
);

$this->menu=array(
	array('label'=>'List SegContacts', 'url'=>array('index')),
	array('label'=>'Create SegContacts', 'url'=>array('create')),
	array('label'=>'Update SegContacts', 'url'=>array('update', 'id'=>$model->idcontacts)),
	array('label'=>'Delete SegContacts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idcontacts),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegContacts', 'url'=>array('admin')),
);
?>

<h1>View SegContacts #<?php echo $model->idcontacts; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idcontacts',
		'firstname',
		'surname',
		'phone',
		'email',
		'additional_address',
		'country',
		'city',
		'postalcode',
		'house',
		'street',
		'birthdate',
	),
)); ?>
