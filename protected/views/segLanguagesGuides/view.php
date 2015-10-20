<?php
/* @var $this SegLanguagesGuidesController */
/* @var $model SegLanguagesGuides */

$this->breadcrumbs=array(
	'Seg Languages Guides'=>array('index'),
	$model->idseg_languages_guides,
);

$this->menu=array(
	array('label'=>'List SegLanguagesGuides', 'url'=>array('index')),
	array('label'=>'Create SegLanguagesGuides', 'url'=>array('create')),
	array('label'=>'Update SegLanguagesGuides', 'url'=>array('update', 'id'=>$model->idseg_languages_guides)),
	array('label'=>'Delete SegLanguagesGuides', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idseg_languages_guides),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SegLanguagesGuides', 'url'=>array('admin')),
);
?>

<h1>View SegLanguagesGuides #<?php echo $model->idseg_languages_guides; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idseg_languages_guides',
		'users_id',
		'languages_id',
	),
)); ?>
