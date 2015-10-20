<?php
/* @var $this UsergroupsController */
/* @var $data Usergroups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idusergroups')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idusergroups), array('view', 'id'=>$data->idusergroups)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groupname')); ?>:</b>
	<?php echo CHtml::encode($data->groupname); ?>
	<br />


</div>