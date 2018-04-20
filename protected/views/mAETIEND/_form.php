<?php
/* @var $this MAETIENDController */
/* @var $model MAETIEND */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'maetiend-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
        <?php echo $form->textField($model, 'COD_CLIE', array('size' => 6, 'maxlength' => 6)); ?>
        <?php echo $form->error($model, 'COD_CLIE'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
        <?php echo $form->textField($model, 'COD_TIEN', array('size' => 6, 'maxlength' => 6)); ?>
        <?php echo $form->error($model, 'COD_TIEN'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'DES_TIEN'); ?>
        <?php echo $form->textField($model, 'DES_TIEN', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'DES_TIEN'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'DIR_TIEN'); ?>
        <?php echo $form->textField($model, 'DIR_TIEN', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'DIR_TIEN'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'COD_ESTA'); ?>
        <?php echo $form->textField($model, 'COD_ESTA', array('size' => 1, 'maxlength' => 1)); ?>
        <?php echo $form->error($model, 'COD_ESTA'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'USU_DIGI'); ?>
        <?php echo $form->textField($model, 'USU_DIGI', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'USU_DIGI'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'FEC_DIGI'); ?>
        <?php echo $form->textField($model, 'FEC_DIGI'); ?>
        <?php echo $form->error($model, 'FEC_DIGI'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'USU_MODI'); ?>
        <?php echo $form->textField($model, 'USU_MODI', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'USU_MODI'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'FEC_MODI'); ?>
        <?php echo $form->textField($model, 'FEC_MODI'); ?>
        <?php echo $form->error($model, 'FEC_MODI'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->