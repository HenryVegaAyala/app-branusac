<?php
/* @var $this MAEPRODUController */
/* @var $model MAEPRODU */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'COD_PROD'); ?>
		<?php echo $form->textField($model,'COD_PROD',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_LINE'); ?>
		<?php echo $form->textField($model,'COD_LINE',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DES_LARG'); ?>
		<?php echo $form->textField($model,'DES_LARG',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DES_CORT'); ?>
		<?php echo $form->textField($model,'DES_CORT',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_ESTA'); ?>
		<?php echo $form->textField($model,'COD_ESTA',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_MEDI'); ?>
		<?php echo $form->textField($model,'COD_MEDI',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_PESO'); ?>
		<?php echo $form->textField($model,'VAL_PESO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_PROD'); ?>
		<?php echo $form->textField($model,'VAL_PROD',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_CONV'); ?>
		<?php echo $form->textField($model,'VAL_CONV'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_PORC'); ?>
		<?php echo $form->textField($model,'VAL_PORC',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_COST'); ?>
		<?php echo $form->textField($model,'VAL_COST',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VAL_REPO'); ?>
		<?php echo $form->textField($model,'VAL_REPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COD_LOTE'); ?>
		<?php echo $form->textField($model,'COD_LOTE'); ?>
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