<?php

$count = count($idguia);

$pdf = Yii::createComponent('application.extensions.MPDF.mpdf');
$mpdf = new mPDF('utf-8', array(215, 215), 11, 'Arial', 12, 12, 12, 12, 'L');
for ($i = 0; $i < $count; $i++) {

    $mpdf->WriteHTML(getHtmlCabecera($idguia[$i])); //Cabezera
    $mpdf->WriteHTML(getHtmlCuerpo($idguia[$i]));  //Cuerpo
    $mpdf->WriteHTML(getHtmlDetalle($idguia[$i])); //detalle


    $mpdf->SetTitle("Reporte Guía Masiva");
    $mpdf->SetAuthor("IMPRENTA BRANUSAC");
    $mpdf->SetWatermarkText(Estado($idguia[$i]));
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;

    if ($i <> ($count - 1))
        $mpdf->AddPage(); //aÃ±ades mientras no seas ultima pagina
}

$FECFACT = date("dmY");
$Reporte = "GUIA_MASIVA_$FECFACT.pdf";

$mpdf->Output($Reporte, 'I');
$this->renderPartial('index');

/*     * *****************************REPORTE***************************************** */

function getHtmlCabecera($id)
{

    $html = '
    <link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/bootstrap/bootstrap.css" />

<style>
    img{
        width: 140px;
    }
    hr{
        color: #373737;
        background-color: #373737;
        height: 5px;
        margin-top: .1em;
    }
    table, td{
        border-radius: 15px;
        vertical-align: top;
    }
</style>

<table border="0" class="table">
    <tr>

    <td style="border: solid white" width="10%">
        <center>
                <img style="float:left;" src="' . Yii:: app()->request->baseUrl . '/images/logo.png">
        </center>
    </td>

    <td style="border: solid white; border-width:1px 0;" width="50%">
            <center><h3><strong>Imprenta Branusac S.A.C </strong></h3></center>
            <br>
            <p>
           Av. Aviación 3368, 15036            <br> 
            Lima - Lima - San Borja <br>
            Telf: (01)475-5008       <br>
            www.branusac.com
            </p>
    </td>

        <td style="border-radius: 15px;border: solid black;" width="40%" >
            <center><strong><h2>R.U.C. 20536040995</h2></strong></center>
            <br>
            <p>
            <h4>
            GUÍA REMISIÓN - REMITENTE<br>
            </h4>
            </p>
            <br>
            <p>
            <h4>
            0001 - N° ' . $id . '<br>
            </h4>
            </p>
        </td>
    </tr>
</table>';

    return $html;
}

function getHtmlCuerpo($id)
{

    $connection = Yii::app()->db;
    $sqlStatement = "SELECT FEC_TRAS,DIR_TIEN,DES_CLIE,NRO_RUC FROM fac_guia_remis F
                            inner join mae_clien C on F.COD_CLIE = C.COD_CLIE
                            inner join mae_tiend T on F.COD_TIEN = T.COD_TIEN
                            where COD_GUIA ='" . $id . "';";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row = $reader->read()) {
        $Fecha = $row['FEC_TRAS'];
        $Ruc = $row['NRO_RUC'];
        $Descli = $row['DES_CLIE'];
        $DirTien = $row['DIR_TIEN'];
    }

    $Fecha_Fac = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha));
    $Ppartida = "Calle Ayabaca 173";

    $html = '
                <link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/bootstrap/bootstrap.css" />

<style>
        img{
            width: 140px;
           }
        hr{
           color: #373737;
            background-color: #373737;
            height: 5px;
            margin-top: .1em;
           }
        td{
           border-radius: 15px;
           }
</style>
<div class="hr"><hr /></div>

  <table class="table  /*table-bordered*/" border= "0">

   <tr>
        <td colspan="4">Fecha inicio de traslado: ' . strtoupper($Fecha_Fac) . '</td>
   </tr>

   <br><br>

   <tr>
    <td colspan="2" >Destinatario: ' . strtoupper('hipermercados ' . $Descli) . '</td>
    <td colspan="2" >Punto de Partida: ' . strtoupper($Ppartida) . '</td>
   </tr>

   <br><br>

   <tr>
    <td  colspan="2" >R.U.C: ' . strtoupper($Ruc) . ' </td>
    <td  colspan="2" >Punto de Llegada: ' . strtoupper($DirTien) . '</td>
   </tr>

    <br><br>

  </table>
    ';
    return $html;
}

function getHtmlDetalle($id)
{
    $connection = Yii::app()->db;
    $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,M.VAL_PESO,M.COD_MEDI  FROM fac_detal_guia_remis F
                        inner join mae_produ M on F.COD_PROD = M.COD_PROD
                        where COD_GUIA = '" . $id . "' ;";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();

    $html .= '
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center; vertical-align: center;">Cantidad</th>
    <th style="text-align: center;">Descripción</th>
    <th style="text-align: center;">Peso Total</th>
    <th style="text-align: center;">Precio Unitario</th>
    <th style="text-align: center;">Importe Total</th>
    </tr>
';

    while ($row = $reader->read()) {


        $html .= '

        <tr>
        <td style="text-align: center;" width="10%" > ' . $row['UNI_SOLI'] . ' </td>
        <td style="text-align: left "  width="50%">' . $row['DES_LARG'] . ' </td>
        <td style="text-align: center;" width="8%"> ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'] . '</td>
        <td style="text-align: center;" width="10%"> ' . $row['VAL_PROD'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['IMP_PROD'] . ' </td>
        </tr>

        ';
    }
    $html .= '</table>';

    $html .= '

 <table border="0" class="table">
    <tbody>
        <tr>
            <td style="text-align: center;">___________________________________________</td>
            <td style="text-align: center;">___________________________________________</td>
        </tr>
        <tr>
            <td style="text-align: center;">Conforme</td>
            <td style="text-align: center;">IMPRENTA BRANUSAC S.A.C</td>
        </tr>
    </tbody>
</table>


<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Pag. {PAGENO} / {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />

<div style="text-align: center;">DESTINATARIO</div>';

    return $html;
}

/*     * *****************************REPORTE***************************************** */

function Estado($id)
{
    $connection = Yii::app()->db;
    $sqlStatement = "SELECT IND_ESTA FROM FAC_GUIA_REMIS F where COD_GUIA  = '" . $id . "';";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row = $reader->read()) {
        $Estado = $row['IND_ESTA'];
    }

    switch ($Estado) {
        case 1:
            return 'Emitida / Pendiente de cobro';
            break;
        case 2:
            return 'Cobrada / Cerrada';
            break;
        case 9:
            return 'Anulado';
            break;
        case 0:
            return 'Creado';
            break;
    }
}