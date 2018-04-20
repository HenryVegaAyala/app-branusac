<?php
/* @var $this MAECLIENController */
/* @var $data MAECLIEN */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_CLIE')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_CLIE), array('view', 'id'=>$data->COD_CLIE)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DES_CLIE')); ?>:</b>
	<?php echo CHtml::encode($data->DES_CLIE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIR_FISC')); ?>:</b>
	<?php echo CHtml::encode($data->DIR_FISC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NRO_RUC')); ?>:</b>
	<?php echo CHtml::encode($data->NRO_RUC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_DEPT')); ?>:</b>
	<?php echo CHtml::encode($data->COD_DEPT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_PROV')); ?>:</b>
	<?php echo CHtml::encode($data->COD_PROV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_DIST')); ?>:</b>
	<?php echo CHtml::encode($data->COD_DIST); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('NRO_TEL1')); ?>:</b>
	<?php echo CHtml::encode($data->NRO_TEL1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NRO_TEL2')); ?>:</b>
	<?php echo CHtml::encode($data->NRO_TEL2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NRO_TEL3')); ?>:</b>
	<?php echo CHtml::encode($data->NRO_TEL3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIR_WEB')); ?>:</b>
	<?php echo CHtml::encode($data->DIR_WEB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIR_EMA1')); ?>:</b>
	<?php echo CHtml::encode($data->DIR_EMA1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIR_EMA2')); ?>:</b>
	<?php echo CHtml::encode($data->DIR_EMA2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIR_EMA3')); ?>:</b>
	<?php echo CHtml::encode($data->DIR_EMA3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_ESTA')); ?>:</b>
	<?php echo CHtml::encode($data->COD_ESTA); ?>
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