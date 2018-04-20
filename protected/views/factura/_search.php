<?php
/* @var $this FacturaController */
/* @var $model Factura */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="fieldset">

        <div class="container-fluid">

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'COD_FACT'); ?>
                <?php echo $form->textField($model, 'COD_FACT', array('class' => 'form-control input-sm')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'COD_GUIA'); ?>
                <?php echo $form->textField($model, 'COD_GUIA', array('class' => 'form-control input-sm')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'COD_CLIE'); ?>
                <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaCliente(), array('class' => 'form-control input-sm', 'empty' => 'Seleccionar Estado')); ?>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-sm-4 control-label">
                <?php echo $form->label($model, 'FEC_FACT'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'FEC_FACT',
                    'value' => $model->FEC_FACT,
                    'language' => 'es',
                    'htmlOptions' => array('class' => 'form-control input-sm', 'placeholder' => 'Fecha Facturada'),
                    'options' => array(
                        'autoSize' => true,
                        'defaultDate' => $model->FEC_FACT,
                        'dateFormat' => 'dd/mm/yy',
                        'buttonImageOnly' => true,
                        'buttonText' => 'FEC_FACT',
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
                <?php echo $form->label($model, 'FEC_PAGO'); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'FEC_PAGO',
                    'value' => $model->FEC_PAGO,
                    'language' => 'es',
                    'htmlOptions' => array('class' => 'form-control input-sm', 'placeholder' => 'Fecha de Pago'),
                    'options' => array(
                        'autoSize' => true,
                        'defaultDate' => $model->FEC_PAGO,
                        'dateFormat' => 'dd/mm/yy',
                        'buttonImageOnly' => true,
                        'buttonText' => 'FEC_PAGO',
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
                <?php echo $form->label($model, 'IND_ESTA'); ?>
                <?php echo $form->dropDownList($model, 'IND_ESTA', $model->Estado(), array('class' => 'form-control input-sm', 'empty' => 'Seleccionar Estado')); ?>
            </div>

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

    <?php $this->endWidget(); ?>

</div><!-- search-form -->