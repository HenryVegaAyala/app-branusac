<?php
/* @var $this OCController */
/* @var $model OC */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'post',
    ));
    ?>

    <div class="fieldset">

        <div class="container-fluid">

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'COD_CLIE'); ?>
                <?php echo $form->dropDownList($model, 'COD_CLIE', $model->VistaCliente(), array('class' => 'form-control input-sm', 'empty' => 'Seleccionar Cliente')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'NUM_ORDE'); ?>
                <?php echo $form->textField($model, 'NUM_ORDE', array('class' => 'form-control input-sm', 'placeholder' => 'Ingrese N° de Orden')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'IND_ESTA'); ?>
                <?php echo $form->dropDownList($model, 'IND_ESTA', $model->Estado(), array('class' => 'form-control input-sm', 'empty' => 'Seleccionar Estado')); ?>
            </div>
        </div>

        <div class="container-fluid">
            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'FEC_INGR'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'FEC_INGR',
                    'value' => $model->FEC_INGR,
                    'language' => 'es',
                    'htmlOptions' => array('class' => 'form-control input-sm', 'placeholder' => 'Fecha Ingreso'),
                    'options' => array(
                        'autoSize' => true,
                        'defaultDate' => $model->FEC_INGR,
                        'dateFormat' => 'dd/mm/yy',
                        'buttonImageOnly' => true,
                        'buttonText' => 'FEC_INGR',
                        'selectOtherMonths' => true,
                        'showAnim' => 'fadeIn', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'showOtherMonths' => true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'maxDate' => "+20Y",
                    ),
                ));
                ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'FEC_ENVI'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'FEC_ENVI',
                    'value' => $model->FEC_ENVI,
                    'language' => 'es',
                    'htmlOptions' => array('class' => 'form-control input-sm', 'placeholder' => 'Fecha de Envio'),
                    'options' => array(
                        'autoSize' => true,
                        'defaultDate' => $model->FEC_ENVI,
                        'dateFormat' => 'dd/mm/yy',
                        'buttonImageOnly' => true,
                        'buttonText' => 'FEC_ENVI',
                        'selectOtherMonths' => true,
                        'showAnim' => 'fadeIn', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'showOtherMonths' => true,
                        'changeMonth' => 'true',
                        'changeYear' => 'true',
                        'maxDate' => "+20Y",
                    ),
                ));
                ?>
            </div>
        </div>

        <br>

        <div class="panel-footer " style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php
                    $this->widget(
                        'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'success',
                        'label' => 'Buscar',
                        'size' => 'default',
                        'buttonType' => 'submit',
                        'icon' => 'fa fa-search'
                    ));
                    ?>
                    <?php
                    $this->widget(
                        'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'default',
                        'label' => 'Limpiar',
                        'size' => 'default',
                        'buttonType' => 'reset',
                        'icon' => 'fa fa-times'
                    ));
                    ?>
                    <?php echo CHtml::link('Cerrar Búsqueda','#', array('class' => 'search-button btn btn-default btn-md')); ?>
                </div>
            </div>
        </div>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->