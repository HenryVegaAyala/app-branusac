<?php
/* @var $this OCController */
/* @var $model OC */

$this->pageTitle = 'Detalle del Presupuesto';
$this->breadcrumbs = array(
    'Detalle Presupuesto' => array('index'),
    'N° - ' . $model->NUM_ORDE
);
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <center>
                <h3 class="panel-title">Vista Detallada Presupuesto N° -
                    <big><strong><?php echo $model->NUM_ORDE; ?></strong></big></h3>
            </center>
        </div>

        <?php
        $moneda = "";
        switch ($model->TIP_MONE) {
            case '0':
                $moneda = 'PE – Nuevo Soles';
                break;
            case '1':
                $moneda = 'US –Dólares Americanos';
                break;
            default :
                $moneda = "";
        }

        $estado = "";
        switch ($model->IND_ESTA) {
            case '1':
                $estado = 'En Proceso';
                break;
            case '2':
                $estado = 'Despachadado/Atendido';
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

        $FEC_INGRE = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($model->FEC_INGR));

        $FEC_ENVI = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($model->FEC_ENVI));

        $this->widget('ext.bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'type' => 'bordered condensed striped raw',
            'attributes' => array(
                array(
                    'name' => 'N&#176 de Factura',
                    'value' => $this->ResultadoFact($model->COD_ORDE)
                ),
                array(
                    'name' => 'N&#176 de Guia',
                    'value' => $this->ResultadoGuia($model->COD_ORDE)
                ),
                array(
                    'name' => 'Nombre del Cliente',
                    'value' => $model->getCliente($model->COD_CLIE)
                ),
                array(
                    'name' => 'Nombre de Tienda',
                    'value' => $model->getTienda($model->COD_TIEN)
                ),
                array(
                    'name' => 'Tipo de Moneda',
                    'value' => $moneda
                ),
                array(
                    'name' => 'FEC_INGR',
                    'header' => 'Fecha de Ingreso',
                    'value' => $FEC_INGRE,
                ),
                array(
                    'name' => 'FEC_ENVI',
                    'header' => 'Fecha de Envio',
                    'value' => $FEC_ENVI,
                ),
                array(
                    'name' => 'Estado',
                    'value' => $estado
                ),
                'TOT_MONT_ORDE',
                'TOT_MONT_IGV',
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
    $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.NRO_UNID,F.VAL_PREC,F.VAL_MONT_UNID FROM FAC_DETAL_ORDEN_COMPR F
            inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
            where F.COD_CLIE = '" . $model->COD_CLIE . "' and F.COD_TIEN = '" . $model->COD_TIEN . "' and F.COD_ORDE = '" . $model->COD_ORDE . "';";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row1 = $reader->read()) {
        echo '<tr>';
        echo '<td>' . $row1['COD_PROD'] . '</td>';
        echo '<td>' . $row1['DES_LARG'] . '</td>';
        echo '<td>' . $row1['NRO_UNID'] . '</td>';
        echo '<td>' . $row1['VAL_PREC'] . '</td>';
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
        'url' => array('index')
    ));
    ?>
</div>


