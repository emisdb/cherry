<?php
/* @var $this SegGuidesdataController */
/* @var $data SegGuidesdata */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idseg_guidesdata')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idseg_guidesdata), array('view', 'id'=>$data->idseg_guidesdata)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('base_provision')); ?>:</b>
	<?php echo CHtml::encode($data->base_provision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash_box')); ?>:</b>
	<?php echo CHtml::encode($data->cash_box); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide_shorttext')); ?>:</b>
	<?php echo CHtml::encode($data->guide_shorttext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guide_maintext')); ?>:</b>
	<?php echo CHtml::encode($data->guide_maintext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lnk_to_picture')); ?>:</b>
	<?php echo CHtml::encode($data->lnk_to_picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guest_variable')); ?>:</b>
	<?php echo CHtml::encode($data->guest_variable); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('paysUSt')); ?>:</b>
	<?php echo CHtml::encode($data->paysUSt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guestsMinforVariable')); ?>:</b>
	<?php echo CHtml::encode($data->guestsMinforVariable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxnumber')); ?>:</b>
	<?php echo CHtml::encode($data->taxnumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('taxoffice')); ?>:</b>
	<?php echo CHtml::encode($data->taxoffice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoiceCount2013')); ?>:</b>
	<?php echo CHtml::encode($data->invoiceCount2013); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoiceCount2014')); ?>:</b>
	<?php echo CHtml::encode($data->invoiceCount2014); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inVoiceCount2015')); ?>:</b>
	<?php echo CHtml::encode($data->inVoiceCount2015); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_cashbox')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_cashbox); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_provision')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_provision); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('immediate_voucher_payment')); ?>:</b>
	<?php echo CHtml::encode($data->immediate_voucher_payment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guides_cashbox_account_DTV')); ?>:</b>
	<?php echo CHtml::encode($data->guides_cashbox_account_DTV); ?>
	<br />

	*/ ?>

</div>