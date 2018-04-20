<?php

$mpdf = Yii::createComponent('application.extensions.MPDF.mpdf');

//$model->fACGUIAREMIS;

function Pllegada($Tienda) {
    $connection = Yii::app()->db;
    $sqlStatement = "SELECT DIR_TIEN FROM mae_tiend M where COD_TIEN  = '" . $Tienda . "' ;";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row = $reader->read()) {
        $des = $row['DIR_TIEN'];
    }
    return $des;
}

function PDesti($Cliente) {
    $connection = Yii::app()->db;
    $sqlStatement = "SELECT DES_CLIE FROM mae_clien M where COD_CLIE  = '" . $Cliente . "' ;";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row = $reader->read()) {
        $des = $row['DES_CLIE'];
    }
    return $des;
}

function Ruc($Cliente) {
    $connection = Yii::app()->db;
    $sqlStatement = "SELECT NRO_RUC FROM mae_clien M where COD_CLIE  = '" . $Cliente . "' ;";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row = $reader->read()) {
        $des = $row['NRO_RUC'];
    }
    return $des;
}

$Ppartida = "Calle Ayabaca 173";

$FEC_TRAS = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($model->FEC_TRAS));

$FECFACT = date("dmY");

$Reporte = "GuiaDeRemision-N°$model->COD_GUIA-$FECFACT.pdf";

$html.= '
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
            GUÍA DE REMISION - REMITENTE<br> 
            </h4>
            </p>
            <br>
            <p>
            <h4>
            0001 - N° ' . $model->COD_GUIA . '<br> 
            </h4>
            </p>
        </td> 
    </tr>
</table>';

$html.='
<div class="hr"><hr /></div>

  <table class="table  /*table-bordered*/" border= "0">

   <tr>
        <td colspan="4">Fecha inicio de trasalado: ' . strtoupper($FEC_TRAS) . '</td>
   </tr>
   
   <br><br>
   
   <tr>
    <td colspan="2" >Destinatario: ' . strtoupper('hipermercados ' . PDesti($model->COD_CLIE)) . '</td>     
    <td colspan="2" >Punto de Partida: ' . strtoupper($Ppartida) . '</td>                                                          
   </tr>
   
   <br><br>
   
   <tr>
    <td  colspan="2" >R.U.C: ' . strtoupper(Ruc($model->COD_CLIE)) . ' </td>            
    <td  colspan="2" >Punto de Llegada: ' . strtoupper(Pllegada($model->COD_TIEN)) . '</td> 
   </tr>
   
    <br><br>
    
  </table>
';

$connection = Yii::app()->db;
$sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.NRO_UNID,F.VAL_PREC,F.VAL_MONT_UNID FROM fac_detal_orden_compr F
            inner join mae_produ M on F.COD_PROD = M.COD_PROD
            where F.COD_CLIE = '" . $model->COD_CLIE . "' and F.COD_TIEN = '" . $model->COD_TIEN . "' and F.COD_ORDE = '" . $model->COD_ORDE . "';";
$command = $connection->createCommand($sqlStatement);
$reader = $command->query();

$html.='
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


    $html.= '
       
        <tr>
        <td style="text-align: center;" width="10%" > ' . $row['NRO_UNID'] . ' </td>
        <td style="text-align: rigth;"  width="50%">' . $row['DES_LARG'] . ' </td>
        <td style="text-align: center;" width="8%"> ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'] . '</td>
        <td style="text-align: center;" width="10%"> ' . $row['VAL_PREC'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['VAL_MONT_UNID'] . ' </td>
        </tr>

        ';
}
$html.='</table>';

$html.='

 <table border="0" class="table">
    <tbody>
        <tr>
            <td style="text-align: center;">___________________________________________</td>
            <td style="text-align: center;">___________________________________________</td>
        </tr>
        <tr>
            <td style="text-align: center;">Conforme</td>
            <td style="text-align: center;">Imprenta Branusac S.A.C</td>
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

<div style="text-align: center;">DESTINATARIO</div>

';


$mpdf = new mPDF('utf-8', array(215, 215), 11, 'Arial', 12, 12, 12, 12, 'L');

$mpdf->WriteHTML($html);
$mpdf->WriteHTML($html1);

$mpdf->SetTitle("GUIA DE REMISIÓN");
$mpdf->SetAuthor("Imprenta Branusac");
$mpdf->SetWatermarkText("GUÍA DE REMISION");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->Output($Reporte,'I');
exit;

//==============================================================
//==============================================================
//==============================================================
?> 
