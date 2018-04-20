<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facguiaremis-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_GUIA'); ?>
		<?php echo $form->textField($model,'COD_GUIA',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_GUIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_ORDE'); ?>
		<?php echo $form->textField($model,'COD_ORDE',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_ORDE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_TIEN'); ?>
		<?php echo $form->textField($model,'COD_TIEN',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'COD_TIEN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_CLIE'); ?>
		<?php echo $form->textField($model,'COD_CLIE',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'COD_CLIE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEC_EMIS'); ?>
		<?php echo $form->textField($model,'FEC_EMIS'); ?>
		<?php echo $form->error($model,'FEC_EMIS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIR_PART'); ?>
		<?php echo $form->textField($model,'DIR_PART',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DIR_PART'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEC_TRAS'); ?>
		<?php echo $form->textField($model,'FEC_TRAS'); ?>
		<?php echo $form->error($model,'FEC_TRAS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COS_FLET'); ?>
		<?php echo $form->textField($model,'COS_FLET',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'COS_FLET'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_EMPR_TRAN'); ?>
		<?php echo $form->textField($model,'COD_EMPR_TRAN',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'COD_EMPR_TRAN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_UNID_TRAN'); ?>
		<?php echo $form->textField($model,'COD_UNID_TRAN',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'COD_UNID_TRAN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_MOTI_TRAS'); ?>
		<?php echo $form->textField($model,'COD_MOTI_TRAS',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'COD_MOTI_TRAS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IND_ESTA'); ?>
		<?php echo $form->textField($model,'IND_ESTA',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'IND_ESTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USU_DIGI'); ?>
		<?php echo $form->textField($model,'USU_DIGI',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'USU_DIGI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEC_DIGI'); ?>
		<?php echo $form->textField($model,'FEC_DIGI'); ?>
		<?php echo $form->error($model,'FEC_DIGI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'USU_MODI'); ?>
		<?php echo $form->textField($model,'USU_MODI',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'USU_MODI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEC_MODI'); ?>
		<?php echo $form->textField($model,'FEC_MODI'); ?>
		<?php echo $form->error($model,'FEC_MODI'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->