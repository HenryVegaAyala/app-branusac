<?php
/* @var $this MAEPRODUController */
/* @var $data MAEPRODU */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_PROD')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_PROD), array('view', 'id'=>$data->COD_PROD)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_LINE')); ?>:</b>
	<?php echo CHtml::encode($data->COD_LINE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DES_LARG')); ?>:</b>
	<?php echo CHtml::encode($data->DES_LARG); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DES_CORT')); ?>:</b>
	<?php echo CHtml::encode($data->DES_CORT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_ESTA')); ?>:</b>
	<?php echo CHtml::encode($data->COD_ESTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_MEDI')); ?>:</b>
	<?php echo CHtml::encode($data->COD_MEDI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_PESO')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_PESO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_CONV')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_CONV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_PORC')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_PORC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_COST')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_COST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_REPO')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_REPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_LOTE')); ?>:</b>
	<?php echo CHtml::encode($data->COD_LOTE); ?>
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