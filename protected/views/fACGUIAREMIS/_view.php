<?php
/* @var $this FACGUIAREMISController */
/* @var $data FACGUIAREMIS */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_GUIA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_GUIA), array('view', 'id'=>$data->COD_GUIA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_ORDE')); ?>:</b>
	<?php echo CHtml::encode($data->COD_ORDE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_TIEN')); ?>:</b>
	<?php echo CHtml::encode($data->COD_TIEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_CLIE')); ?>:</b>
	<?php echo CHtml::encode($data->COD_CLIE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_EMIS')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_EMIS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIR_PART')); ?>:</b>
	<?php echo CHtml::encode($data->DIR_PART); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEC_TRAS')); ?>:</b>
	<?php echo CHtml::encode($data->FEC_TRAS); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('COS_FLET')); ?>:</b>
	<?php echo CHtml::encode($data->COS_FLET); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_EMPR_TRAN')); ?>:</b>
	<?php echo CHtml::encode($data->COD_EMPR_TRAN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_UNID_TRAN')); ?>:</b>
	<?php echo CHtml::encode($data->COD_UNID_TRAN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_MOTI_TRAS')); ?>:</b>
	<?php echo CHtml::encode($data->COD_MOTI_TRAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IND_ESTA')); ?>:</b>
	<?php echo CHtml::encode($data->IND_ESTA); ?>
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