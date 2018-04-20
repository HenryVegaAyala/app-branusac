<?php
/* @var $this MAETIENDController */
/* @var $data MAETIEND */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_TIEN')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_TIEN), array('view', 'id'=>$data->COD_TIEN)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_CLIE')); ?>:</b>
	<?php echo CHtml::encode($data->COD_CLIE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DES_TIEN')); ?>:</b>
	<?php echo CHtml::encode($data->DES_TIEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIR_TIEN')); ?>:</b>
	<?php echo CHtml::encode($data->DIR_TIEN); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('USU_MODI')); ?>:</b>
	<?php echo CHtml::encode($data->USU_MODI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_MODI')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_MODI); ?>
	<br />

	*/ ?>

</div>