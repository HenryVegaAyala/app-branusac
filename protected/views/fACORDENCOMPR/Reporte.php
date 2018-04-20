<?php

$pdf = Yii::createComponent('application.extensions.MPDF.mpdf');

//$model = new FACORDENCOMPR();

$Coc = $model->COD_ORDE;
$cliente = $model->COD_CLIE;
$Tienda = $model->COD_TIEN;
$oc = $model->NUM_ORDE;
$FecIng = $model->FEC_INGR;
$FecEnv = $model->FEC_ENVI;
$Est = $model->IND_ESTA;

$NewFecIng = date("d-M-Y", strtotime($FecIng));
$NewFecEnv = date("d-M-Y", strtotime($FecEnv));

function Estado($data) {

    switch ($data) {
        case 0:
            return 'Creado';
            break;
        case 1:
            return 'En Proceso';
            break;
        case 2:
            return 'Despacho/Atendido';
            break;
        case 9:
            return 'Anulado';
            break;
    }
}

$FECFACT = date("dmY");

$Reporte = "Presupuesto-N°$oc-$FECFACT.pdf";


$connection = Yii::app()->db;
$sqlStatement = "SELECT C.DES_CLIE, T.DES_TIEN,C.NRO_RUC FROM mae_tiend T
                     inner join mae_clien C on C.COD_CLIE = T.COD_CLIE
                     where T.COD_TIEN = '" . $Tienda . "' and C.COD_CLIE = '" . $cliente . "' ;";
$command = $connection->createCommand($sqlStatement);
$reader = $command->query();
while ($row = $reader->read()) {

    $htmlCA = '
<html>

    <link rel="stylesheet" type="text/css" href="' . Yii::app()->request->baseUrl . '/css/bootstrap/bootstrap.css" />

<style>
        img{
            width: 120px;
           }
        hr{
           color: #373737;
            background-color: #373737;
            height: 5px;
            margin-top: .1em;
           }
</style>
     
<table border="0" class="table">
    <tr>
        <td>
            <center>
                <img style="float:left;" src="' . Yii:: app()->request->baseUrl . '/images/logo.png">
            </center>
        </td>
        
        <td>
            <center><strong><h2>Imprenta Branusac</h2></strong></center>
            <br>
            <center>Av. Aviación 3368, 15036</center>
            <center>Lima - Lima - San Borja</center>
            <center>Telf: (01)475-5008</center>
            <center>www.branusac.com</center>
        </td>        
    </tr>
</table>

<div class="hr"><hr /></div>

<table border="0" class="table">
     <tr>
        <td width="50%" >Señor(es): HIPERMERCADOS ' . $row['DES_CLIE'] . ' - ' . $row['DES_TIEN'] . '</td>
        <td width="25%" >RUC: ' . $row['NRO_RUC'] . ' </td>
        <td width="25%" >N° O/C: ' . $oc . ' </td>
     </tr>
</table>

<table border="0" class="table">
     <tr>
        <td width="33.33333333333333%" >Fecha Ingreso: ' . $NewFecIng . '</td>
        <td width="33.33333333333333%" >Fecha Envio: ' . $NewFecEnv . ' </td>
        <td width="33.33333333333333%" >Estado: ' . Estado($Est) . ' </td>
     </tr>
</table>';
}
?>

<?php

$sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.NRO_UNID,F.VAL_PREC,F.VAL_MONT_UNID,M.VAL_PESO,M.COD_MEDI  FROM fac_detal_orden_compr F
            inner join mae_produ M on F.COD_PROD = M.COD_PROD
            where F.COD_CLIE = '" . $model->COD_CLIE . "' and F.COD_TIEN = '" . $model->COD_TIEN . "' and F.COD_ORDE = '" . $model->COD_ORDE . "';";
$command = $connection->createCommand($sqlStatement);
$reader = $command->query();

$htmlCU.='
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center;">Codigo</th>
    <th style="text-align: center;">Descripción</th>
    <th style="text-align: center;">Cantidad</th>
    <th style="text-align: center;">Precio</th>
    </tr>    
';

while ($row = $reader->read()) {


    $htmlCU.= '
       
        <tr>
        <td style="text-align: center;" width="10%" > ' . $row['COD_PROD'] . ' </td>
        <td style="text-align: rigth;"  width="70%">' . $row['DES_LARG'] . ' ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['NRO_UNID'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['VAL_PREC'] . ' </td>
        </tr>

        ';
}
$htmlCU.='</table>'
?>
<?php

$htmlDE = '

        <table border="0" class="table table-bordered table-condensed">
            <tr>
                <td width="46%" style="text-align: right;" rowspan="2"></td>                
                <th width="18%" style="text-align: center;" colspan="1">SUB-TOTAL</th>
                <th width="18%" style="text-align: center;" colspan="1">I.G.V</th>
                <th width="18%" style="text-align: center;" colspan="1">TOTAL</th>
            </tr>
            <tr>
                <td width="18%" style="text-align: center;" colspan="1">'.$model->TOT_MONT_ORDE.'</td>
                <td width="18%" style="text-align: center;" colspan="1">'.$model->TOT_MONT_IGV.'</td>
                <td width="18%" style="text-align: center;" colspan="1">'.$model->TOT_FACT.'</td>
            </tr>   
        </table>  

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Pag. {PAGENO} / {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />

';
?>


<?php

$mpdf = new mPDF('A4');
$mpdf->SetTitle("REPORTE PRESUPUESTO");
$mpdf->SetAuthor("IMPRENTA Branusac");
$mpdf->SetWatermarkText("ORDEN DE COMPRA");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->WriteHTML($htmlCA); //Cabezera
$mpdf->WriteHTML($htmlCU);  //Cuerpo
$mpdf->WriteHTML($htmlDE);
$mpdf->Output($Reporte,'I');
exit;
//<table border="1" class="table">
//     <tr>
//        <th width="25%" >Codigo</th>
//        <th width="25%" >Descripción</th>
//        <th width="25%" >Cantidad</th>
//        <th width="25%" >Precio</th>
//     </tr>
//</table>