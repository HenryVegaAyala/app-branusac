<?php
/* @var $this MAETIENDController */
/* @var $model MAETIEND */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COD_CLIE'); ?>
		<?php echo $form->textField($model,'COD_CLIE',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_TIEN'); ?>
		<?php echo $form->textField($model,'COD_TIEN',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DES_TIEN'); ?>
		<?php echo $form->textField($model,'DES_TIEN',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIR_TIEN'); ?>
		<?php echo $form->textField($model,'DIR_TIEN',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_ESTA'); ?>
		<?php echo $form->textField($model,'COD_ESTA',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USU_DIGI'); ?>
		<?php echo $form->textField($model,'USU_DIGI',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_DIGI'); ?>
		<?php echo $form->textField($model,'FEC_DIGI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USU_MODI'); ?>
		<?php echo $form->textField($model,'USU_MODI',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEC_MODI'); ?>
		<?php echo $form->textField($model,'FEC_MODI'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->