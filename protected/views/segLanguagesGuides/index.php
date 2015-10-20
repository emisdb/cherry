<?php
/* @var $this SegLanguagesGuidesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Languages Guides',
);

$this->menu=array(
	array('label'=>'Create SegLanguagesGuides', 'url'=>array('create')),
	array('label'=>'Manage SegLanguagesGuides', 'url'=>array('admin')),
);
?>

<h1>Seg Languages Guides</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
