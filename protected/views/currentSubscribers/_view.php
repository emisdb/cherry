<?php
/* @var $this CurrentSubscribersController */
/* @var $data CurrentSubscribers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_contact')); ?>:</b>
	<?php echo CHtml::encode($data->id_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tourist')); ?>:</b>
	<?php echo CHtml::encode($data->tourist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_rabatt')); ?>:</b>
	<?php echo CHtml::encode($data->id_rabatt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_payoption')); ?>:</b>
	<?php echo CHtml::encode($data->id_payoption); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vat')); ?>:</b>
	<?php echo CHtml::encode($data->vat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_guide')); ?>:</b>
	<?php echo CHtml::encode($data->id_guide); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tour')); ?>:</b>
	<?php echo CHtml::encode($data->id_tour); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_report')); ?>:</b>
	<?php echo CHtml::encode($data->id_report); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_zakaz')); ?>:</b>
	<?php echo CHtml::encode($data->date_zakaz); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_report')); ?>:</b>
	<?php echo CHtml::encode($data->date_report); ?>
	<br />

	*/ ?>

</div>