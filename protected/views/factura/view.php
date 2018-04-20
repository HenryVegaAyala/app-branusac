<?php
/* @var $this FacturaController */
/* @var $model Factura */

$this->breadcrumbs = array(
    'Detalle Factura' => array('index'),
);
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <center>
                <h3 class="panel-title">Vista Detallada del N° de Factura:
                    <big><strong><?php echo $model->COD_FACT; ?></strong></big></h3>
            </center>
        </div>

        <?php
        $estado = "";
        switch ($model->IND_ESTA) {
            case '1':
                $estado = 'Emitida/Pendiente de Cobro';
                break;
            case '2':
                $estado = 'Cobrada/Cerrada';
                break;
            case '9':
                $estado = 'Anulado';
                break;
            case '0':
                $estado = 'Creado';
                break;
            default :
                $estado = "";
        }

        $FEC_FACT = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($model->FEC_FACT));
        $FEC_PAGO = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($model->FEC_PAGO));

        ?>
        <?php
        $this->widget('ext.bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'type' => 'bordered condensed striped raw',
            'attributes' => array(
                array(
                    'name' => 'N&#176 de Guia',
                    'value' => $this->ResultadoGuia($model->COD_FACT)),
                array(
                    'name' => 'N&#176 de O/C',
                    'value' => $this->ResultadoOc($model->COD_FACT)),
                array(
                    'name' => 'Nombre del Cliente',
                    'value' => $model->getCliente($model->COD_CLIE)),
                array(
                    'name' => 'Fecha Facturada',
                    'value' => $FEC_FACT),
                array(
                    'name' => 'Fecha de Pago',
                    'value' => $FEC_PAGO),
                array(
                    'name' => 'Estado',
                    'value' => $estado),
                'TOT_FACT_SIN_IGV',
                'TOT_IGV',
                'TOT_FACT',
            ),
        ));
        ?>

    </div>

    <?php
    echo '<table class="table table-hover table-bordered table-condensed table-striped">';
    echo '<tr>';
    echo '<th style="text-align: center;" class="col-md-2">Codigo</th>';
    echo '<th style="text-align: center;" >Descripción</th>';
    echo '<th style="text-align: center;" class="col-md-1">Cantidad</th>';
    echo '<th style="text-align: center;" class="col-md-1">Precio</th>';
    echo '</tr>';
    $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD FROM FAC_DETAL_FACTU F
            inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
            where F.COD_FACT = '" . $model->COD_FACT . "';";

    $connection = Yii::app()->db;
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row1 = $reader->read()) {
        echo '<tr>';
        echo '<td>' . $row1['COD_PROD'] . '</td>';
        echo '<td>' . $row1['DES_LARG'] . '</td>';
        echo '<td>' . $row1['UNI_SOLI'] . '</td>';
        echo '<td>' . $row1['VAL_PROD'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    ?>
</div>

<br>

<div class="container-fluid" align="right">
    <?php
    $this->widget(
        'ext.bootstrap.widgets.TbButton', array(
        'context' => 'success',
        'label' => 'Regresar',
        'size' => 'small',
        'buttonType' => 'link',
        'icon' => 'chevron-left',
        'url' => array('/factura/index')
    ));
    ?>
</div>