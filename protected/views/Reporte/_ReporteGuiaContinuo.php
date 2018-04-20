<?php

$count = count($idguia);

yii::import('application.extensions.fpdf.*');

class PDF extends fpdf {

    function Cabecera($i) {

        $connection = Yii::app()->db;
        $sqlStatement = "SELECT COD_GUIA,FEC_TRAS,DIR_TIEN,DES_CLIE,NRO_RUC FROM FAC_GUIA_REMIS F
                            inner join MAE_CLIEN C on F.COD_CLIE = C.COD_CLIE
                            inner join MAE_TIEND T on F.COD_TIEN = T.COD_TIEN
                            where COD_GUIA = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        while ($row = $reader->read()) {
            $idguia = $row['COD_GUIA'];
            $Fecha = $row['FEC_TRAS'];
            $Ruc = $row['NRO_RUC'];
            $Descli = $row['DES_CLIE'];
            $DirTien = $row['DIR_TIEN'];
        }

        $Fecha_Fac = Yii::app()->dateFormatter->format("dd MMMM y", strtotime($Fecha));

        $this->SetFont('Arial', '', 9);
        $this->Ln();
        $this->Cell(18, 3, '', 0);
        $this->Ln();
        $this->Cell(9, 0.5, '', 0, '', 'C');
        $this->Cell(9, 0.5, utf8_decode(strtoupper($idguia)), 0, '', 'C');
        $this->Ln();
        $this->Cell(2, 1, '', 0);
        $this->Cell(16, 0.6, utf8_decode(strtoupper($Fecha_Fac)), 0);
        $this->Ln();
        $this->Cell(2, 1, '', 0);
        $this->Cell(9, 0.6, utf8_decode(strtoupper($Descli)), 0);
        $this->Cell(2, 1, '', 0);
        $this->Cell(5, 0.6, strtoupper('CALLE AYABACA 173'), 0, '', 'R');
        $this->Ln();
        $this->Cell(2, 1, '', 0);
        $this->Cell(9, 0.6, utf8_decode(strtoupper($Ruc)), 0);
        $this->Cell(2, 1, '', 0);
        $this->Cell(5, 0.6, strtoupper($DirTien), 0, '', 'R');
        $this->Ln();

//        $this->Cell(Ancho , Alto , cadena , bordes , posici��n , alinear , fondo, URL )
    }

    function Cuerpo($i) {
        $connection = Yii::app()->db;
        $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,M.VAL_PESO,M.COD_MEDI  FROM fac_detal_guia_remis F
                        inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
                        where COD_GUIA = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        while ($row = $reader->read()) {
            
            $unid = $row['UNI_SOLI'];
            $product = strtoupper($row['DES_LARG']);
            $medidas =  ($row['VAL_PESO'] . ' ' . $row['COD_MEDI']);
            $val = $row['VAL_PROD'];
            $precTo = $row['IMP_PROD'];

            $this->SetFont('Arial', '', 9);
            $this->Ln();
            $this->Cell(2, 0.5, number_format($unid), 0, '', 'L');
            $this->Cell(10, 0.5, utf8_decode(strtoupper($product)), 0);
            $this->Cell(2, 0.5, utf8_decode($medidas), 0, '', 'C');
            $this->Cell(2, 0.5, strtoupper($val), 0, '', 'C');
            $this->Cell(2, 0.5, strtoupper($precTo), 0, '', 'R');
        }
    }

    function Detalle($i) {
        $connection = Yii::app()->db;
        $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,F.IGV_PROD,F.IMP_TOTA_PROD,M.VAL_PESO,M.COD_MEDI,FF.TOT_FACT_SIN_IGV,FF.TOT_IGV,FF.TOT_FACT  FROM FAC_DETAL_FACTU F
        inner join MAE_PRODU M on F.COD_PROD = M.COD_PROD
        inner join FAC_FACTU FF on F.COD_FACT = FF.COD_FACT
        where F.COD_FACT = '" . $i . "';";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();
        while ($row = $reader->read()) {
            $Stotal = $row['TOT_FACT_SIN_IGV'];
            $IGVPRO = $row['TOT_IGV'];
            $Total = $row['TOT_FACT'];
        }
        $this->SetFont('Arial', '', 9);
        $this->SetXY(1.8, 17);
        $this->Cell(2, 0.5, '', 0, '', 'C');
       // $this->Cell(16, 0.5, utf8_decode(strtoupper(numtoletras($Total))), 0);
        $this->Ln();
        $this->Cell(12, 1, '', 0, '', 'C');
       // $this->Cell(2, 1, strtoupper($Stotal), 0, '', 'C');
        // $this->Cell(2, 1, strtoupper($IGVPRO), 0, '', 'C');
        // $this->Cell(2, 1, strtoupper($Total), 0, '', 'C');
    }

    function Impresion($i) {

        $this->Cabecera($i);
        $this->Cuerpo($i);
        $this->Detalle($i);
    }

    function AutoPrint($dialog = false) {
        //Open the print dialog or start printing immediately on the standard printer
        $param = ($dialog ? 'true' : 'false');
        $script = "print($param);";
        $this->IncludeJS($script);
    }

    function AutoPrintToPrinter($server, $printer, $dialog = false) {
        //Print on a shared printer (requires at least Acrobat 6)
        $script = "var pp = getPrintParams();";
        if ($dialog)
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        else
            $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
        $script .= "pp.printerName = '\\\\\\\\" . $server . "\\\\" . $printer . "';";
        $script .= "print(pp);";
        $this->IncludeJS($script);
    }

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
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el l��mite a 6 d��gitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya lleg�� al l��mite m��ximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d��gitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres d��gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)) {  // busco si la centena es n��mero redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = $this->subfijo($xaux); // devuelve el subfijo correspondiente (Mill��n, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aqu�� si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma l��gica que las centenas)
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

        // ----------- esta l��nea la puedes cambiar de acuerdo a tus necesidades o a tu pa��s -------
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
        // ------------------      en este caso, para M��xico se usa esta leyenda     ----------------
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

function subfijo($xx) { // esta funci��n regresa un subfijo para la cifra
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

$pdf = new PDF('P', 'cm', 'A4');

$pdf->SetMargins(1.1, 0.8, 1.3);
$pdf->SetTopMargin(2.3);
for ($i = 0; $i < $count; $i++) {

    if ($i <> ($count))
        $pdf->AddPage(); //a�0�9ades mientras no seas ultima pagina

    $pdf->Impresion($idguia[$i]);

    $pdf->SetTitle("REPORTE GUIA MASIVO");
    $pdf->SetAuthor("IMPRENTA BRANUSAC");
}
//$pdf->AutoPrint(true);
$FECFACT = date("dmY");
$Reporte = "Guia_Masiva_$FECFACT.pdf";

$pdf->Output($Reporte, 'D');
