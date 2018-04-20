<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */

$this->breadcrumbs = array(
    'Detalle Guia' => array('index'),
);
?>

<br>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <center>
                <h3 class="panel-title">Vista Detallada del N° de Guia: <big><strong><?php echo $model->COD_GUIA; ?></strong></big></h3>
            </center>
        </div>
        <?php
        $estado = "";
        switch ($model->IND_ESTA) {
            case '1':
                $estado = 'Emitida / Pendiente de cobro';
                break;
            case '2':
                $estado = 'Cobrada / Cerrada';
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
        $FEC_INGRE = Yii::app()->dateFormatter->format("dd/MMMM/y", strtotime($model->FEC_EMIS));

        $FEC_ENVI = Yii::app()->dateFormatter->format("dd/MMMM/y", strtotime($model->FEC_TRAS));

        $cli = $model->cODCLIE->COD_CLIE;

        $oc = $model->COD_ORDE;

        function getFac($id) {
            $model = new FACGUIAREMIS();
            if ($id != "") {
                return $model->getFactura($id);
            } else {
                return "Sin Factura";
            }
        }
        ?>

        <?php
        $this->widget('ext.bootstrap.widgets.TbDetailView', array(
            'data' => $model,
            'type' => 'bordered condensed striped raw',
            'attributes' => array(
                array(
                    'name' => 'N&#176 de O/C',
                    'value' => $model->getOc($oc)),
                array(
                    'name' => 'N&#176 de Factura',
                    'value' => getFac($model->COD_GUIA)),
                array(
                    'name' => 'Nombre del Cliente',
                    'value' => $model->getCliente($cli)),
                array(
                    'name' => 'Nombre de la Tienda',
                    'value' => $model->getTienda($cli)),
                array(
                    'name' => 'FEC_EMIS',
                    'header' => 'Fecha de Ingreso',
                    'value' => $FEC_INGRE,
                ),
                array(
                    'name' => 'FEC_TRAS',
                    'header' => 'Fecha de Envio',
                    'value' => $FEC_ENVI,
                ),
                array(
                    'name' => 'Estado',
                    'value' => $estado),
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
    $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.NRO_UNID,F.VAL_PREC,F.VAL_MONT_UNID FROM fac_detal_orden_compr F
            inner join mae_produ M on F.COD_PROD = M.COD_PROD
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