<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php
/* @var $this GuiaController */
/* @var $model Guia */
/* @var $form CActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Actualizar Guía N° - <?php echo $model->COD_GUIA ?></h3>
    </div>

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'guia-form',
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

            <div class="col-sm-4 control-label">
                <?php echo $form->labelEx($model, 'COD_GUIA'); ?>
                <?php echo $form->textField($model, 'COD_GUIA', array('class' => 'form-control input-sm', 'readonly' => 'true')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->labelEx($model, 'COD_ORDE'); ?>
                <?php echo $form->dropDownList($model, 'COD_ORDE', $model->OrdenCompra(), array('class' => 'form-control input-sm', 'disabled' => 'true')); ?>
            </div>

            <div class="col-sm-4 control-label">
                <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
                <?php echo $form->dropDownList($model, 'COD_TIEN', $model->ListaTiendaUpdate(), array('class' => 'form-control input-sm', 'disabled' => 'true')); ?>
            </div>
        </div>

        <div class="container-fluid">

            <div class="col-sm-4 control-label">
                <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaClienteUpdate(), array('class' => 'form-control input-sm', 'disabled' => 'true')); ?>
            </div>

            <div class="col-sm-3 control-label">
                <?php echo $form->labelEx($model, 'FEC_EMIS'); ?>
                <input type="text" id="Guia_FEC_EMIS" name="Guia[FEC_EMIS]" class="form-control input-sm"
                       placeholder="Ingrese la Fecha Envio"
                       value=" <?php echo date("d/m/Y", strtotime($model->FEC_EMIS)) ?>" required="true"/>
                <script>
                    $(function () {
                        $("#Guia_FEC_EMIS").datepicker();
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
                <input type="text" value="<?php echo $row['NRO_RUC'] ?>" id="txtruc"
                       class="form-control input-sm "
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
                <input type="text" value="<?php echo $row['DIR_TIEN'] ?>" id="txtDIRE"
                       class="form-control input-sm"
                       style="border:none; background-color: transparent;"
                       disabled="true"/>
            </div>
        </div>
    </div>

    <div class="panel-footer">
    </div>

    <?php
    echo '<table class="table table-hover table-bordered table-condensed table-striped">';
    echo '<tr>';
    echo '<th style="text-align: center;" class="col-md-2">Codigo</th>';
    echo '<th style="text-align: center;" >Descripción</th>';
    echo '<th style="text-align: center;" class="col-md-1">Cantidad</th>';
    echo '<th style="text-align: center;" class="col-md-1">Precio</th>';
    echo '<th style="text-align: center;" class="col-md-1">Total</th>';
    echo '</tr>';
    $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.NRO_UNID,F.VAL_PREC,F.VAL_MONT_UNID FROM FAC_DETAL_ORDEN_COMPR F
            inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
            where F.COD_CLIE = '" . $model->COD_CLIE . "' and F.COD_TIEN = '" . $model->COD_TIEN . "' and F.COD_ORDE = '" . $model->COD_ORDE . "';";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row1 = $reader->read()) {
        echo '<tr>';
        echo '<td>' . $row1['COD_PROD'] . '</td>';
        echo '<td>' . $row1['DES_LARG'] . '</td>';
        echo '<td>' . $row1['NRO_UNID'] . '</td>';
        echo '<td>' . $row1['VAL_PREC'] . '</td>';
        echo '<td>' . ($row1['NRO_UNID'] * $row1['VAL_PREC']) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    ?>

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
                    'url' => array('index')
                ));
                ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>
<!-- form -->
