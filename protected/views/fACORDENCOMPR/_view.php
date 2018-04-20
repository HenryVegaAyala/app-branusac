<?php
/* @var $this FACORDENCOMPRController */
/* @var $data FACORDENCOMPR */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('NUM_ORDE')); ?>:</b>
	<?php echo CHtml::encode($data->NUM_ORDE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IND_TIPO')); ?>:</b>
	<?php echo CHtml::encode($data->IND_TIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIP_MONE')); ?>:</b>
	<?php echo CHtml::encode($data->TIP_MONE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_UNID_SOLI')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_UNID_SOLI); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_MONT_ORDE')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_MONT_ORDE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_MONT_IGV')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_MONT_IGV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOT_FACT')); ?>:</b>
	<?php echo CHtml::encode($data->TOT_FACT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_PAGO')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_PAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IND_ESTA')); ?>:</b>
	<?php echo CHtml::encode($data->IND_ESTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_INGR')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_INGR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_ENVI')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_ENVI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_ANUL')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_ANUL); ?>
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