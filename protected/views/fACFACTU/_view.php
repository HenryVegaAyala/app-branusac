<?php
/* @var $this FACFACTUController */
/* @var $data FACFACTU */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_FACT')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_FACT), array('view', 'id'=>$data->COD_FACT)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_CLIE')); ?>:</b>
	<?php echo CHtml::encode($data->COD_CLIE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_GUIA')); ?>:</b>
	<?php echo CHtml::encode($data->COD_GUIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_FACT')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_FACT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_PAGO')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_PAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IND_ESTA')); ?>:</b>
	<?php echo CHtml::encode($data->IND_ESTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_IGV')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_IGV); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_UNID_FACT')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_UNID_FACT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_FACT_SIN_IGV')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_FACT_SIN_IGV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_IGV')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_IGV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_FACT')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_FACT); ?>
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