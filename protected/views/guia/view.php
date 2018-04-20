<?php
/* @var $this GuiaController */
/* @var $model Guia */

$this->breadcrumbs = array(
    'Detalle Guia' => array('index'),
);
?>

<br>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <center>
                <h3 class="panel-title">Vista Detallada del N° de Guia:
                    <big><strong><?php echo $model->COD_GUIA; ?></strong></big></h3>
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

        $FEC_INGRE = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($model->FEC_EMIS));

        $FEC_ENVI = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($model->FEC_TRAS));


        function getFac($id)
        {
            $model = new Guia();
            if ($id != "") {
                //return $model->getFactura($id);
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
                    'value' => $this->ResultadoOC($model->COD_GUIA)
                ),
                array(
                    'name' => 'N&#176 de Factura',
                    'value' => $this->ResultadoFactura($model->COD_GUIA)
                ),
                array(
                    'name' => 'Nombre Cliente',
                    'value' => $this->ResultadoCliente($model->COD_CLIE)
                ),
                array(
                    'name' => 'Nombre Tienda',
                    'value' => $this->ResultadoTienda($model->COD_CLIE)
                ),
                array(
                    'name' => 'FEC_EMIS',
                    'value' => $FEC_INGRE,
                ),
                /* array(
                     'name' => 'Fecha transporte',
                     'value' => $FEC_ENVI,
                 ),*/
                array(
                    'name' => 'Estado',
                    'value' => $estado
                ),
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
    echo '<th style="text-align: center;" class="col-md-1">Total</th>';
    echo '</tr>';
    $sqlStatement = "SELECT C.COD_PROD, C.DES_LARG,A.UNI_SOLI,A.VAL_PROD,A.IMP_TOTA_PROD FROM fac_detal_guia_remis A
                        INNER JOIN fac_guia_remis B ON A.COD_GUIA = B.COD_GUIA
                        INNER JOIN MAE_PRODU C ON A.COD_PROD = C.COD_PROD
           WHERE B.COD_CLIE = '" . $model->COD_CLIE . "' and B.COD_TIEN = '" . $model->COD_TIEN . "' and B.COD_GUIA = '" . $model->COD_GUIA . "';";
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row1 = $reader->read()) {
        echo '<tr>';
        echo '<td>' . $row1['COD_PROD'] . '</td>';
        echo '<td>' . $row1['DES_LARG'] . '</td>';
        echo '<td>' . $row1['UNI_SOLI'] . '</td>';
        echo '<td>' . $row1['VAL_PROD'] . '</td>';
        echo '<td>' . $row1['IMP_TOTA_PROD'] . '</td>';
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