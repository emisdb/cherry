<?php
/* @var $this LanguagesController */
/* @var $data Languages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_languages')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_languages), array('view', 'id'=>$data->id_languages)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shortname')); ?>:</b>
	<?php echo CHtml::encode($data->shortname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('germanname')); ?>:</b>
	<?php echo CHtml::encode($data->germanname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('englishname')); ?>:</b>
	<?php echo CHtml::encode($data->englishname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flagpic')); ?>:</b>
	<?php echo CHtml::encode($data->flagpic); ?>
	<br />


</div>