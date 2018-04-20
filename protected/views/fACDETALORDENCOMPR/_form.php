<?php
/* @var $this FACDETALORDENCOMPRController */
/* @var $model FACDETALORDENCOMPR */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facdetalordencompr-form',
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
		<?php echo $form->labelEx($model,'COD_TIEN'); ?>
		<?php echo $form->textField($model,'COD_TIEN',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'COD_TIEN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_ORDE'); ?>
		<?php echo $form->textField($model,'COD_ORDE',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_ORDE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_PROD'); ?>
		<?php echo $form->textField($model,'COD_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NRO_UNID'); ?>
		<?php echo $form->textField($model,'NRO_UNID'); ?>
		<?php echo $form->error($model,'NRO_UNID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_PREC'); ?>
		<?php echo $form->textField($model,'VAL_PREC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'VAL_PREC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_IGV'); ?>
		<?php echo $form->textField($model,'VAL_IGV',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'VAL_IGV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_MONT_UNID'); ?>
		<?php echo $form->textField($model,'VAL_MONT_UNID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'VAL_MONT_UNID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_MONT_IGV'); ?>
		<?php echo $form->textField($model,'VAL_MONT_IGV',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'VAL_MONT_IGV'); ?>
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