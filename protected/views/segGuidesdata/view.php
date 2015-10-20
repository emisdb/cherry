<?php
/* @var $this SegGuidesdataController */
/* @var $model SegGuidesdata */

$this->breadcrumbs=array(
	'Seg Guidesdatas'=>array('index'),
	$model->idseg_guidesdata,
);

$this->menu=array(
	array('label'=>'List SegGuidesdata', 'url'=>array('index')),
	array('label'=>'Create SegGuidesdata', 'url'=>array('create')),
	array('label'=>'Update SegGuidesdata', 'url'=>array('update', 'id'=>$model->idseg_guidesdata)),
	array('label'=>'Delete SegGuidesdata', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_guidesdata),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegGuidesdata', 'url'=>array('admin')),
);
?>

<h1>View SegGuidesdata #<?php echo $model->idseg_guidesdata; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_guidesdata',
		'base_provision',
		'cash_box',
		'guide_shorttext',
		'guide_maintext',
		'lnk_to_picture',
		'guest_variable',
		'paysUSt',
		'guestsMinforVariable',
		'taxnumber',
		'taxoffice',
		'invoiceCount2013',
		'invoiceCount2014',
		'inVoiceCount2015',
		'voucher_cashbox',
		'voucher_provision',
		'immediate_voucher_payment',
		'guides_cashbox_account_DTV',
	),
)); ?>
