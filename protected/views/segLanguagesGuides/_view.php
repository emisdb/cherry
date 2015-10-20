<?php
/* @var $this SegLanguagesGuidesController */
/* @var $data SegLanguagesGuides */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_languages_guides')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_languages_guides), array('view', 'id'=>$data->idseg_languages_guides)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('users_id')); ?>:</b>
	<?php echo CHtml::encode($data->users_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('languages_id')); ?>:</b>
	<?php echo CHtml::encode($data->languages_id); ?>
	<br />


</div>