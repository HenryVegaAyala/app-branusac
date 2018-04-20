<?php
/* @var $this FACDETALGUIAREMISController */
/* @var $data FACDETALGUIAREMIS */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('GUIA_DET')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->GUIA_DET), array('view', 'id'=>$data->GUIA_DET)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_GUIA')); ?>:</b>
	<?php echo CHtml::encode($data->COD_GUIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->COD_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PES_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->PES_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UNI_SOLI')); ?>:</b>
	<?php echo CHtml::encode($data->UNI_SOLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMP_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->IMP_PROD); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('IGV_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->IGV_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMP_TOTA_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->IMP_TOTA_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USU_DIGI')); ?>:</b>
	<?php echo CHtml::encode($data->USU_DIGI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_DIGI')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_DIGI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USU_MODI')); ?>:</b>
	<?php echo CHtml::encode($data->USU_MODI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_MODI')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_MODI); ?>
	<br />

	*/ ?>

</div>