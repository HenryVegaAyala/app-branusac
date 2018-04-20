<?php
/* @var $this FACDETALGUIAREMISController */
/* @var $model FACDETALGUIAREMIS */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facdetalguiaremis-form',
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
		<?php echo $form->labelEx($model,'COD_PROD'); ?>
		<?php echo $form->textField($model,'COD_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PES_PROD'); ?>
		<?php echo $form->textField($model,'PES_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'PES_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UNI_SOLI'); ?>
		<?php echo $form->textField($model,'UNI_SOLI',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'UNI_SOLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_PROD'); ?>
		<?php echo $form->textField($model,'VAL_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'VAL_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IMP_PROD'); ?>
		<?php echo $form->textField($model,'IMP_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'IMP_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IGV_PROD'); ?>
		<?php echo $form->textField($model,'IGV_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'IGV_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IMP_TOTA_PROD'); ?>
		<?php echo $form->textField($model,'IMP_TOTA_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'IMP_TOTA_PROD'); ?>
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