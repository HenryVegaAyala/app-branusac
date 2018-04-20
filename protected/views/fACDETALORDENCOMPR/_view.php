<?php
/* @var $this FACDETALORDENCOMPRController */
/* @var $data FACDETALORDENCOMPR */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_ORDE')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_ORDE), array('view', 'id'=>$data->COD_ORDE)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_CLIE')); ?>:</b>
	<?php echo CHtml::encode($data->COD_CLIE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_TIEN')); ?>:</b>
	<?php echo CHtml::encode($data->COD_TIEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_PROD')); ?>:</b>
	<?php echo CHtml::encode($data->COD_PROD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NRO_UNID')); ?>:</b>
	<?php echo CHtml::encode($data->NRO_UNID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_PREC')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_PREC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_IGV')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_IGV); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_MONT_UNID')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_MONT_UNID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAL_MONT_IGV')); ?>:</b>
	<?php echo CHtml::encode($data->VAL_MONT_IGV); ?>
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