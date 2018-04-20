<?php

Yii::import("ext.PHPExcel.XPHPExcel");
$objPHPExcel = XPHPExcel::createPHPExcel();

set_time_limit(900);

$objPHPExcel->getProperties()->setCreator("Arunsri")
    ->setLastModifiedBy("Arunsri")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'N° de Factura')
    ->setCellValue('B1', 'Cliente')
    ->setCellValue('C1', 'Tienda')
    ->setCellValue('D1', 'Fecha Facturada')
    ->setCellValue('E1', 'Fecha de Pago')
    ->setCellValue('F1', 'Estado')
    ->setCellValue('G1', 'N° de Guia R.')
    ->setCellValue('H1', 'N° de Presupuesto')
    ->setCellValue('I1', 'Total');


$StyleCuerpo = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => false,
        'italic' => false,
        'strike' => false,
        'size' => 9,
        'color' => array(
            'rgb' => '6, 0, 2'
        )
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        //'wrap' => TRUE
    ),
);

$sql = "SELECT
  A.COD_FACT,
  B.DES_CLIE,
  C.DES_TIEN,
  A.FEC_FACT,
  A.FEC_PAGO,
  CASE  A.IND_ESTA
  WHEN A.IND_ESTA='1' THEN 'PENDIENTE DE PAGO'
  WHEN A.IND_ESTA='2' THEN 'COBRADO'
  WHEN A.IND_ESTA='9' THEN 'ANULADO'
  END AS  ESTADO,
  'SIN GUIA R.',
  'SIN Presupuesto',
  A.TOT_FACT
FROM fac_factu A
INNER JOIN mae_clien B ON A.COD_CLIE = B.COD_CLIE
INNER JOIN mae_tiend C ON C.COD_TIEN = A.COD_TIEN;";
$datas = Yii::app()->db->createCommand($sql)->queryAll();

$i = 2;

foreach ($datas as $data) {

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . $i, $data['COD_FACT'])
        ->setCellValue('B' . $i, $data['DES_CLIE'])
        ->setCellValue('C' . $i, $data['DES_TIEN'])
        ->setCellValue('D' . $i, $data['FEC_FACT'])
        ->setCellValue('E' . $i, $data['FEC_PAGO'])
        ->setCellValue('F' . $i, $data['ESTADO'])
        // ->setCellValue('G' . $i, $data[''])
        // ->setCellValue('H' . $i, $data[''])
        ->setCellValue('I' . $i, $data['TOT_FACT'])
        ->getStyle("A".$i.":I".$i."")
        ->applyFromArray($StyleCuerpo);
    $i++;
}

$StyleCabecera = array(
    'font' => array(
        'name' => 'Arial',
        'bold' => true,
        'italic' => false,
        'strike' => false,
        'size' => 11,
        'color' => array(
            'rgb' => '6, 0, 2'
        )
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        //'wrap' => TRUE
    ),
    /*
'fill' => array(
   'type' => PHPExcel_Style_Fill::FILL_SOLID,
   'color' => array(
       'rgb' => '6, 0, 2')
),*/
);


//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->getAutoSize(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($StyleCabecera);



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);

$objPHPExcel->getSheet(0)->setTitle("Facturas-" . date('d-m-Y'));
$objPHPExcel->setActiveSheetIndex(0);

$reporte = ob_get_clean();
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=Facturas-" . date('d-m-Y') . ".xls");
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
Yii::app()->end();
echo $reporte;


//$conn = mysqli_connect('sispaal.cnjv4vhhy3or.us-west-2.rds.amazonaws.com', 'root', 'root2016', 'SIS_PANA', '3306');
//if (!$conn) {
//    die('Could not connect to MySQL: ' . mysqli_connect_error());
//}
//mysqli_query($conn, 'SET NAMES \'utf8\'');
//
//
//set_time_limit(900);
//
////$connection = Yii::app()->db;
//$sqlStatement = "SELECT COD_FACT,
// (SELECT DES_CLIE FROM MAE_CLIEN Z WHERE Z.COD_CLIE= Y.COD_CLIE) CLIENTE,
// FEC_FACT,
// Y.FEC_PAGO,
// CASE  Y.IND_ESTA
//    WHEN Y.IND_ESTA='1' THEN 'PENDIENTE PAGO'
//    WHEN Y.IND_ESTA='2' THEN 'COBRADO'
//    WHEN Y.IND_ESTA='9' THEN 'ANULADO'
//   END AS  ESTADO,
//  Z.COD_GUIA,
//  M.NUM_ORDE,
//  Y.TOT_FACT
//FROM fac_factu Y,fac_guia_remis Z,fac_orden_compr M
//WHERE Y.COD_GUIA= Z.COD_GUIA
// AND M.COD_ORDE= Z.COD_ORDE
// ;";
//
//$qry = mysqli_query($conn, $sqlStatement);
//$campos = mysqli_num_fields($qry);
////$command = $connection->createCommand($sqlStatement);
////$reader = $command->query();
//
//ob_start();
//echo "<table border=\"1\" align=\"center\">";
//echo "<tr bgcolor=\"#FFE699\">
//  <td align=\"center\"><font color=\"#000000\"><strong>N&#176 de Factura</strong></font></td>
//  <td align=\"center\"><font color=\"#000000\"><strong>Cliente</strong></font></td>
//  <td align=\"center\"><font color=\"#000000\"><strong>Fecha Facturada/Celular</strong></font></td>
//  <td align=\"center\"><font color=\"#000000\"><strong>Fecha de Pago</strong></font></td>
//  <td align=\"center\"><font color=\"#000000\"><strong>Estado</strong></font></td>
//  <td align=\"center\"><font color=\"#000000\"><strong>N&#176 de Guia Documento</strong></font></td>
//  <td align=\"center\"><font color=\"#000000\"><strong>N&#176 de O/C</strong></font></td>
//  <td align=\"center\"><font color=\"#000000\"><strong>Total</strong></font></td>
//</tr>";
//
//while($row=mysqli_fetch_array($qry))
//{
//    echo "<tr>";
//     for($j=0; $j<$campos; $j++) {
//         echo "<td align=\"left\">".$row[$j]."</td>";
//     }
//     echo "</tr>";
////
////while ($row = $reader->read()) {
////
////
////
//}
//
//echo "</table>";
//$reporte = ob_get_clean();
//header("Content-type: application/vnd.ms-excel; charset=iso-8859-1");
//header("Content-Disposition: attachment; filename=Facturas-" . date('d-m-Y') . ".xls");
//header("Pragma: no-cache");
//header("Expires: 0");
//echo $reporte;
?>
