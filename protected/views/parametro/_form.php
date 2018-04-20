<?php
/* @var $this ParametroController */
/* @var $model Parametro */
/* @var $form CActiveForm */
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Actualizar I.G.V.</h3>
        </div>

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'parametro-form',
            'enableAjaxValidation' => false,
        )); ?>

        <div class="container" style="margin-top: 2%">
            <p class="note" style="font-size: 15px;"><span class="required">*</span> Al cambiar el valor del IGV puede
                afectar en el valor de las <span class="required">FACTURAS.</span></p>
        </div>

        <?php echo $form->errorSummary($model); ?>

        <div class="container-fluid">

            <div class="fieldset">
                <div class="form-group">
                    <div class="col-sm-4">
                        <?php echo $form->labelEx($model, 'VAL_PARA'); ?>
                        <?php echo $form->textField($model, 'VAL_PARA', array('maxlength' => 2, 'class' => 'form-control input-sm')); ?>
                        <?php echo $form->error($model, 'VAL_PARA'); ?>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="panel-footer " style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-12">
                    <?php
                    $this->widget(
                        'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'success',
                        'label' => 'Guardar',
                        'size' => 'md',
                        'icon' => 'fa fa-save fa-lg',
                        'buttonType' => 'submit',
                    ));
                    ?>
                    <?php
                    $this->widget(
                        'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'default',
                        'label' => 'Cancelar',
                        'size' => 'default',
                        'buttonType' => 'link',
                        'icon' => 'fa fa-close fa-lg',
                        'url' => array('index')
                    ));
                    ?>

                </div>
            </div>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
<!-- form -->