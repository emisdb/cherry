<?php
$this->breadcrumbs=array(
	'Scheduled Tours'=>array('officeadmin'),
	'Update',
);

?>

<h1>Update ScheduledTours <?php echo $model->idseg_scheduled_tours; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'languages_guide'=>$languages_guide,'guide_list'=>$guide_list)); ?>