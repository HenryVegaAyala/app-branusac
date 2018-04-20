<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'facfactu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_FACT'); ?>
		<?php echo $form->textField($model,'COD_FACT',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_FACT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_CLIE'); ?>
		<?php echo $form->textField($model,'COD_CLIE',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'COD_CLIE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_GUIA'); ?>
		<?php echo $form->textField($model,'COD_GUIA',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_GUIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEC_FACT'); ?>
		<?php echo $form->textField($model,'FEC_FACT'); ?>
		<?php echo $form->error($model,'FEC_FACT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEC_PAGO'); ?>
		<?php echo $form->textField($model,'FEC_PAGO'); ?>
		<?php echo $form->error($model,'FEC_PAGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IND_ESTA'); ?>
		<?php echo $form->textField($model,'IND_ESTA',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'IND_ESTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_IGV'); ?>
		<?php echo $form->textField($model,'VAL_IGV',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'VAL_IGV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TOT_UNID_FACT'); ?>
		<?php echo $form->textField($model,'TOT_UNID_FACT',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'TOT_UNID_FACT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TOT_FACT_SIN_IGV'); ?>
		<?php echo $form->textField($model,'TOT_FACT_SIN_IGV',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'TOT_FACT_SIN_IGV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TOT_IGV'); ?>
		<?php echo $form->textField($model,'TOT_IGV',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'TOT_IGV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TOT_FACT'); ?>
		<?php echo $form->textField($model,'TOT_FACT',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'TOT_FACT'); ?>
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