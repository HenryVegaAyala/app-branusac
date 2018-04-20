<?php
/* @var $this MAECLIENController */
/* @var $model MAECLIEN */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maeclien-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_CLIE'); ?>
		<?php echo $form->textField($model,'COD_CLIE',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'COD_CLIE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DES_CLIE'); ?>
		<?php echo $form->textField($model,'DES_CLIE',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DES_CLIE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIR_FISC'); ?>
		<?php echo $form->textField($model,'DIR_FISC',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DIR_FISC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NRO_RUC'); ?>
		<?php echo $form->textField($model,'NRO_RUC',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NRO_RUC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_DEPT'); ?>
		<?php echo $form->textField($model,'COD_DEPT',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'COD_DEPT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_PROV'); ?>
		<?php echo $form->textField($model,'COD_PROV',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'COD_PROV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_DIST'); ?>
		<?php echo $form->textField($model,'COD_DIST',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'COD_DIST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NRO_TEL1'); ?>
		<?php echo $form->textField($model,'NRO_TEL1',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NRO_TEL1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NRO_TEL2'); ?>
		<?php echo $form->textField($model,'NRO_TEL2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NRO_TEL2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NRO_TEL3'); ?>
		<?php echo $form->textField($model,'NRO_TEL3',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NRO_TEL3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIR_WEB'); ?>
		<?php echo $form->textField($model,'DIR_WEB',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DIR_WEB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIR_EMA1'); ?>
		<?php echo $form->textField($model,'DIR_EMA1',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DIR_EMA1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIR_EMA2'); ?>
		<?php echo $form->textField($model,'DIR_EMA2',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DIR_EMA2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIR_EMA3'); ?>
		<?php echo $form->textField($model,'DIR_EMA3',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DIR_EMA3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_ESTA'); ?>
		<?php echo $form->textField($model,'COD_ESTA',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'COD_ESTA'); ?>
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