<?php
/* @var $this FolioController */
/* @var $model Folio */
/* @var $form CActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">N° de serie <?php
            $valor = $model->VALOR;
            switch ($valor) {
                case 2:
                    echo 'del Orden de Compra';
                    break;
                case 3:
                    echo 'de la Guia';
                    break;
                case 4:
                    echo 'de la Factura';
                    break;
            }
            ?></h3>
    </div>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'folio-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="container" style="margin-top: 2%">
        <p class="note" style="font-size: 15px;"><span class="required">*</span> Al cambiar el valor del N° de serie
            puede
            afectar en el orden de  <span class="required">
					<?php
                    $valor = $model->VALOR;
                    switch ($valor) {
                        case 2:
                            echo strtoupper('Orden de Compra');
                            break;
                        case 3:
                            echo strtoupper('las Guias');
                            break;
                        case 4:
                            echo strtoupper('las Facturas');
                            break;
                    }
                    ?>
				</span>.</p>
    </div>

    <?php echo $form->errorSummary($model); ?>

    <div class="container-fluid">

        <div class="fieldset">
            <div class="form-group">
                <div class="col-sm-4">
                    <?php echo $form->labelEx($model, 'VAL_ACTU'); ?>
                    <?php echo $form->textField($model, 'VAL_ACTU', array('maxlength' => 6, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'VAL_ACTU'); ?>
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
<!-- form -->