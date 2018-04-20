<?php
/* @var $this MAEPRODUController */
/* @var $model MAEPRODU */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maeprodu-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_PROD'); ?>
		<?php echo $form->textField($model,'COD_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'COD_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_LINE'); ?>
		<?php echo $form->textField($model,'COD_LINE',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'COD_LINE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DES_LARG'); ?>
		<?php echo $form->textField($model,'DES_LARG',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DES_LARG'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DES_CORT'); ?>
		<?php echo $form->textField($model,'DES_CORT',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DES_CORT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_ESTA'); ?>
		<?php echo $form->textField($model,'COD_ESTA',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'COD_ESTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_MEDI'); ?>
		<?php echo $form->textField($model,'COD_MEDI',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'COD_MEDI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_PESO'); ?>
		<?php echo $form->textField($model,'VAL_PESO'); ?>
		<?php echo $form->error($model,'VAL_PESO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_PROD'); ?>
		<?php echo $form->textField($model,'VAL_PROD',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'VAL_PROD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_CONV'); ?>
		<?php echo $form->textField($model,'VAL_CONV'); ?>
		<?php echo $form->error($model,'VAL_CONV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_PORC'); ?>
		<?php echo $form->textField($model,'VAL_PORC',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'VAL_PORC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_COST'); ?>
		<?php echo $form->textField($model,'VAL_COST',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'VAL_COST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VAL_REPO'); ?>
		<?php echo $form->textField($model,'VAL_REPO'); ?>
		<?php echo $form->error($model,'VAL_REPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COD_LOTE'); ?>
		<?php echo $form->textField($model,'COD_LOTE'); ?>
		<?php echo $form->error($model,'COD_LOTE'); ?>
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