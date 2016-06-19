<?php
/* @var $this SegScheduledToursController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seg Scheduled Tours',
);

$this->menu=array(
	array('label'=>'Create SegScheduledTours', 'url'=>array('create')),
	array('label'=>'Manage SegScheduledTours', 'url'=>array('admin')),
);
?>

<h1>Seg Scheduled Tours for <?php echo $id; ?></h1>
<?php echo "ref:".chtml::link("there", array("city","id"=>"munchen")); ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
