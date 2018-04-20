<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php
/* @var $this OCController */
/* @var $model OC */
/* @var $form CActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Actualizar Presupuesto N° - <?php echo $model->NUM_ORDE; ?> </h3>
    </div>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'oc-form',
        'enableAjaxValidation' => true,
    ));
    ?>
    <?php
    echo $form->errorSummary($model);
    ?>

    <script>
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['es']);

    </script>

    <div class="fieldset">

        <div class="container-fluid">

            <div class="col-sm-3 control-label">
                <?php echo $form->labelEx($model, 'NUM_ORDE'); ?>
                <?php echo $form->textField($model, 'NUM_ORDE', array('maxlength' => 12, 'class' => 'form-control input-sm', 'placeholder' => 'N° de Orden', 'readonly' => 'true')); ?>
            </div>

            <div class="col-sm-3 control-label">
                <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaCliente(), array('class' => 'form-control input-sm', 'disabled' => 'true')); ?>
            </div>

            <div class="col-sm-3 control-label">
                <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
                <?php echo $form->dropDownList($model, 'COD_TIEN', $model->ListaTienda($model->COD_CLIE), array('class' => 'form-control input-sm', 'disabled' => 'true')); ?>
            </div>

            <div class="col-sm-3 control-label">
                <?php echo $form->labelEx($model, 'TIP_MONE'); ?>
                <?php echo $form->dropDownList($model, 'TIP_MONE', $model->Moneda(), array('class' => 'form-control input-sm', 'disabled' => 'true')); ?>
                <?php echo $form->error($model, 'TIP_MONE'); ?>
            </div>

        </div>

        <div class="container-fluid">

            <div class="col-sm-3 control-label">
                <?php echo $form->labelEx($model, 'FEC_INGR'); ?>
                <input type="text" id="OC_FEC_INGR" name="OC[FEC_INGR]" class="form-control input-sm"
                       placeholder="Ingrese la Fecha Ingreso" , disabled='true'
                       value=" <?php echo date("d/m/Y", strtotime($model->FEC_INGR)) ?>"
                       required="true"/>
                <script>
                    $(function () {
                        $("#OC_FEC_INGR").datepicker();
                    });
                </script>
            </div>

            <div class="col-sm-3 control-label">
                <?php echo $form->labelEx($model, 'FEC_ENVI'); ?>
                <input type="text" id="OC_FEC_ENVI" name="OC[FEC_ENVI]" class="form-control input-sm"
                       placeholder="Ingrese la Fecha Envio"
                       value=" <?php echo date("d/m/Y", strtotime($model->FEC_ENVI)) ?>"
                       required="true"/>
                <script>
                    $(function () {
                        $("#OC_FEC_ENVI").datepicker();
                    });
                </script>
            </div>
        </div>

    </div>

    <div class="container-fluid">
        <legend class="espacio">Datos del Cliente</legend>
        <div class="form-group ">
            <?php
            $clie = $model->COD_CLIE;
            $tienda = $model->COD_TIEN;

            $connection = Yii::app()->db;
            $sqlStatement = "Select MC.NRO_RUC,MC.DES_CLIE,MT.DIR_TIEN from MAE_CLIEN MC, MAE_TIEND MT where  MC.COD_CLIE = MT.COD_CLIE and MT.COD_ESTA = 1 and MC.COD_ESTA = 1 and MC.COD_CLIE = $clie and MT.COD_TIEN = $tienda;";
            $command = $connection->createCommand($sqlStatement);
            $reader = $command->query();

            foreach ($reader as $row)
            ?>
            <div class="col-sm-4 control-label">
                <label>N° DE RUC:</label>
                <input type="text" value="<?php echo $row['NRO_RUC'] ?>" id="txtruc" class="form-control input-sm "
                       style="border:none; background-color: transparent;"
                       disabled="true"/>
            </div>

            <div class="col-sm-4 control-label">
                <label>RAZÓN SOCIAL:</label>
                <input type="text" value="<?php echo $row['DES_CLIE'] ?>" id="txtRaZo"
                       class="form-control input-sm "
                       style="border:none; background-color: transparent;"
                       disabled="true"/>
            </div>

            <div class="col-sm-4 control-label">
                <label>LUGAR DE ENTREGA:</label>
                <input type="text" value="<?php echo $row['DIR_TIEN'] ?>" id="txtDIRE" class="form-control input-sm"
                       style="border:none; background-color: transparent;"
                       disabled="true"/>
            </div>
        </div>
    </div>

    <br>

    <div class="panel-footer " style="overflow:hidden;text-align:right;">
    </div>

    <div id="add container-fluid">
        <?php
        include __DIR__ . '/../Recurso/Grilla2.php';
        ?>
    </div>

    <div class="container-fluid">
        <table align="right">
            <tbody>
            <tr>
                <td class="col-sm-4 ">
                    <?php echo $form->labelEx($model, 'TOT_MONT_ORDE'); ?>
                </td>
                <td>
                    <?php
                    echo $form->textField($model, 'TOT_MONT_ORDE', array(
                        'class' => 'form-control input-sm',
                        'style' => 'background-color: transparent;',
                        'readonly' => 'readonly'
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td class="col-sm-4">
                    <?php echo $form->labelEx($model, 'TOT_MONT_IGV'); ?>
                </td>
                <td>
                    <?php
                    echo $form->textField($model, 'TOT_MONT_IGV', array(
                        'class' => 'form-control input-sm',
                        'style' => 'background-color: transparent;',
                        'readonly' => 'readonly'
                    ));
                    ?>
                </td>
            </tr>
            <tr>
                <td class="col-sm-4">
                    <?php echo $form->labelEx($model, 'TOT_FACT'); ?>
                </td>
                <td>
                    <?php
                    echo $form->textField($model, 'TOT_FACT', array(
                        'class' => 'form-control input-sm',
                        'style' => 'background-color: transparent;',
                        'readonly' => 'readonly'
                    ))
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="panel-footer container-fluid" style="overflow:hidden;text-align:right;">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php
                $this->widget(
                    'ext.bootstrap.widgets.TbButton', array(
                    'context' => 'success',
                    'label' => 'Guardar',
                    'size' => 'default',
                    'buttonType' => 'submit',
                    'icon' => 'fa fa-floppy-o fa-lg'
                ));
                ?>
                <?php
                $this->widget(
                    'ext.bootstrap.widgets.TbButton', array(
                    'context' => 'default',
                    'label' => 'Cancelar',
                    'size' => 'default',
                    'buttonType' => 'link',
                    'icon' => 'fa fa-times fa-lg',
                    'url' => array('oc/index')
                ));
                ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>
<!-- form -->
