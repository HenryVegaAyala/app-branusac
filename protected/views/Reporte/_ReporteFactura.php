<?php

$count = count($idfactu);

$pdf = Yii::createComponent('application.extensions.MPDF.mpdf');
$mpdf = new mPDF('utf-8', array(215, 215), 11, 'Courier', 12, 12, 12, 12, 'L');
for ($i = 0; $i < $count; $i++) {

    $mpdf->WriteHTML(getHtmlCabecera($idfactu[$i])); //Cabezera
    $mpdf->WriteHTML(getHtmlCuerpo($idfactu[$i]));  //Cuerpo
    $mpdf->WriteHTML(getHtmlDetalle($idfactu[$i])); //detalle


    $mpdf->SetTitle("Reporte Factura");
    $mpdf->SetAuthor("IMPRENTA BRANUSAC");
    $mpdf->SetWatermarkText(Estado($idfactu[$i]));
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;

    if ($i <> ($count - 1))
        $mpdf->AddPage(); //añades mientras no seas ultima pagina
}

$FECFACT = date("dmY");
$Reporte = "Factura_Masiva_$FECFACT.pdf";

$mpdf->Output($Reporte, 'I');


/*     * *************fUNCIONES DE REPORTE */

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
        td{
           border-radius: 15px;
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
            FACTURA<br>
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
</table>
        ';

    return $html;
}

function getHtmlCuerpo($id)
{

    $connection = Yii::app()->db;
    $sqlStatement = "SELECT FEC_FACT,COD_GUIA,NRO_RUC,DES_CLIE,DIR_TIEN FROM fac_factu M
                        inner join mae_clien C on C.COD_CLIE = M.COD_CLIE
                        inner join mae_tiend T on C.COD_CLIE = T.COD_CLIE
                        where COD_FACT  = '" . $id . "';";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row = $reader->read()) {
        $Guia = $row['COD_GUIA'];
        $Fecha = $row['FEC_FACT'];
        $Ruc = $row['NRO_RUC'];
        $Descli = $row['DES_CLIE'];
        $DirTien = $row['DIR_TIEN'];
    }

    $Fecha_Fac = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha));

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

  <table class="table"  border= "0">

   <tr>
        <td colspan="4">Fecha: ' . strtoupper($Fecha_Fac) . '</td>
   </tr>

   <br><br>

   <tr>
    <td colspan="2">Señores: ' . strtoupper('hipermercados ' . $Descli) . '</td>
    <td  colspan="2" >R.U.C: ' . strtoupper($Ruc) . '</td>
   </tr>

   <br><br>

   <tr>
    <td  colspan="2" >Dirección: ' . strtoupper($DirTien) . '</td>
    <td  colspan="2" >N° de Guia: ' . strtoupper($Guia) . ' </td>
   </tr>

    <br><br>

  </table>
    ';
    return $html;
}

function getHtmlDetalle($id)
{

    $connection = Yii::app()->db;
    $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,F.IGV_PROD,F.IMP_TOTA_PROD,M.VAL_PESO,M.COD_MEDI,FF.TOT_FACT_SIN_IGV,FF.TOT_IGV,FF.TOT_FACT  FROM fac_detal_factu F
                        inner join mae_produ M on F.COD_PROD = M.COD_PROD
                        inner join fac_factu FF on F.COD_FACT = FF.COD_FACT
                        where F.COD_FACT = '" . $id . "';";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    $html .= '
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center;">Cantidad</th>
    <th style="text-align: center;">Descripción</th>
    <th style="text-align: center;">Precio Unitario</th>
    <th style="text-align: center;">Total</th>
    </tr>
';

    while ($row = $reader->read()) {
        $Stotal = $row['TOT_FACT_SIN_IGV'];
        $IGVPRO = $row['TOT_IGV'];
        $Total = $row['TOT_FACT'];
        $html .= '

        <tr>
        <td style="text-align: center;" width="10%" > ' . $row['UNI_SOLI'] . ' </td>
        <td style="text-align: rigth;"  width="70%">' . $row['DES_LARG'] . ' ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['VAL_PROD'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['IMP_PROD'] . ' </td>
        </tr>
        ';
    }
    $html .= '
        <tr>
        <td style="text-align: left;" colspan="4">Son: ' . numtoletras($Total) . ' </td>
        </tr>';

    $html .= '</table>';

    $html .= '
        <table border="0" class="table table-bordered table-condensed">
            <tr>
                <td width="46%" style="text-align: right;" rowspan="2"></td>
                <th width="18%" style="text-align: center;" colspan="1">SUB-TOTAL</th>
                <th width="18%" style="text-align: center;" colspan="1">I.G.V</th>
                <th width="18%" style="text-align: center;" colspan="1">PRECIO DE VENTA</th>
            </tr>
            <tr>
                <td width="18%" style="text-align: center;" colspan="1">' . $Stotal . '</td>
                <td width="18%" style="text-align: center;" colspan="1">' . $IGVPRO . '</td>
                <td width="18%" style="text-align: center;" colspan="1">' . $Total . '</td>
            </tr>
            <tr>
                <th width="18%" style="text-align: center;" colspan="5">CANCELADO</th>
            </tr>
        </table>
        ';

    $html .= '
        <table border="0" class="table">
           <tbody>
               <tr>
                   <td width="50%" style="text-align: center;">Lima ______ de ______ del 20 ______.</td>
                   <td width="50%" style="text-align: center;">___________________________________________</td>
               </tr>
               <tr>
                   <td width="50%" style="text-align: center;"></td>
                   <td width="50%" style="text-align: center;">Firma</td>
               </tr>
               <tr>
                   <td width="50%" style="text-align: center;"></td>
                   <th width="50%" style="text-align: right;">ADQUIRIENTE O USUARIO</th>
               </tr>
           </tbody>
       </table>
        ';

    $html .= '

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Pag. {PAGENO} / {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
';

    return $html;
}

function numtoletras($xcifra) {
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)) {  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {

                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CON $xdecimales/100 SOLES";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "CON  $xdecimales/100 SOL ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " CON $xdecimales/100 SOLES "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

function subfijo($xx) { // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

function Estado($id) {

    $connection = Yii::app()->db;
    $sqlStatement = "SELECT IND_ESTA FROM FAC_FACTU F where COD_FACT  = '" . $id . "';";
    $command = $connection->createCommand($sqlStatement);
    $reader = $command->query();
    while ($row = $reader->read()) {
        $Estado = $row['IND_ESTA'];
    }

    switch ($Estado) {
        case 1:
            return 'Emitida/Pendiente de Cobro';
            break;
        case 2:
            return 'Cobrada/Cerrada';
            break;
        case 9:
            return 'Anulado';
            break;
        case 0:
            return 'Creado';
            break;
    }
}