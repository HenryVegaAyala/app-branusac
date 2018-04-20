<?php

class FACGUIAREMISController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated 
                'actions' => array('create', 'update', 'index', 'view',
                    'admin', 'delete', 'Lista', 'Anular',
                    'ajax','Ajax2', 'Factura', 'Reporte', 'Anulado'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAjax() {
        if ($_GET['type'] == 'id_sele') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_ANULA_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();

            //$this->renderPartial('index');
        }

        if ($_GET['type'] == 'id_guia_factu') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_MIGRA_GUIA_TO_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();

            //$this->renderPartial('index');
        }
        //$this->render('index');
        if ($_GET['type'] == 'id_guia') {
            $id = $_GET["id"];
            $idguia = explode("_", $id);
            $count = count($idguia);
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $pdf = Yii::createComponent('application.extensions.MPDF.mpdf');
            $mpdf = new mPDF('utf-8', array(215, 215), 11, 'Arial', 12, 12, 12, 12, 'L');
            for ($i = 0; $i < $count; $i++) {

                $mpdf->WriteHTML($this->getHtmlCabecera($idguia[$i])); //Cabezera
                $mpdf->WriteHTML($this->getHtmlCuerpo($idguia[$i]));  //Cuerpo
                $mpdf->WriteHTML($this->getHtmlDetalle($idguia[$i])); //detalle



                $mpdf->SetTitle("REPORTE GUIA MASIVO");
                $mpdf->SetAuthor("IMPRENTA BRANUSAC");
                $mpdf->SetWatermarkText($this->Estado($idguia[$i]));
                $mpdf->showWatermarkText = true;
                $mpdf->watermark_font = 'DejaVuSansCondensed';
                $mpdf->watermarkTextAlpha = 0.1;

                if ($i <> ($count - 1))
                    $mpdf->AddPage(); //añades mientras no seas ultima pagina
            }

            $FECFACT = date("dmY");
            $Reporte = "GUIA_MASIVA_$FECFACT.pdf";

            $mpdf->Output($Reporte, 'I');
            $this->renderPartial('index');
        }
    }

    /*     * *****************************REPORTE***************************************** */

    public function getHtmlCabecera($id) {

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
            GU�A REMISI�N - REMITENTE<br> 
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

    public function getHtmlCuerpo($id) {

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
        <td colspan="4">Fecha inicio de trasalado: ' . strtoupper($Fecha_Fac) . '</td>
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

    public function getHtmlDetalle($id) {
        $connection = Yii::app()->db;
        $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD,M.VAL_PESO,M.COD_MEDI  FROM fac_detal_guia_remis F
                        inner join mae_produ M on F.COD_PROD = M.COD_PROD
                        where COD_GUIA = '" . $id . "' ;";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();

        $html.='
    <table border="0" class="table table-bordered table-condensed">
    <tr>
    <th style="text-align: center; vertical-align: center;">Cantidad</th>
    <th style="text-align: center;">Descripci�n</th>
    <th style="text-align: center;">Peso Total</th>
    <th style="text-align: center;">Precio Unitario</th>
    <th style="text-align: center;">Importe Total</th>
    </tr>    
';

        while ($row = $reader->read()) {


            $html.= '
       
        <tr>
        <td style="text-align: center;" width="10%" > ' . $row['UNI_SOLI'] . ' </td>
        <td style="text-align: rigth;"  width="50%">' . $row['DES_LARG'] . ' </td>
        <td style="text-align: center;" width="8%"> ' . $row['VAL_PESO'] . ' ' . $row['COD_MEDI'] . '</td>
        <td style="text-align: center;" width="10%"> ' . $row['VAL_PROD'] . ' </td>
        <td style="text-align: center;" width="10%"> ' . $row['IMP_PROD'] . ' </td>
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

<div style="text-align: center;">DESTINATARIO</div>';

        return $html;
    }

    /*     * *****************************REPORTE***************************************** */

    public function actionAjax2() {

        if ($_GET['type'] == 'id_guia') {
            $id = $_GET["id"];
            $idguia = explode("_", $id);

            $this->renderPartial('/Reporte/_ReporteGuiaContinuo', array(
                'idguia' => $idguia,));
        }
    }

    public function actionAnular($id) {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['FACGUIAREMIS']))
            $model->attributes = $_POST['FACGUIAREMIS'];

        $connection = Yii::app()->db;
        $usuario = Yii::app()->user->name;
        $sqlStatement = "call PED_ANULA_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $model->IND_ESTA = '9';
        $this->render('Anulado', array(
            'model' => $model,
        ));
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new FACGUIAREMIS;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FACGUIAREMIS'])) {
            $model->attributes = $_POST['FACGUIAREMIS'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_GUIA));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FACGUIAREMIS'])) {
            $model->attributes = $_POST['FACGUIAREMIS'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_GUIA));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['FACGUIAREMIS']))
            $model->attributes = $_POST['FACGUIAREMIS'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionLista($id) {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FACGUIAREMIS']))
            $model->attributes = $_GET['FACGUIAREMIS'];

        $usuario = Yii::app()->user->name;
        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_OC_TO_GUIA (:id ,:usuario,@out) ;";
        $command = $connection->createCommand($sqlStatement);
        $numoc = $_GET['no'];
        // $command = $connection->createCommand("CALL remove_places(:user_id,:placeID,:place_type,@out)");
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $command->bindParam(":usuario", $usuario, PDO::PARAM_INT);

        $command->execute();
        $valueOut = $connection->createCommand("select @out as result;")->queryScalar();

        if ($valueOut == 0) {
            Yii::app()->user->setFlash('error', 'Por lo menos debe ingresar un producto en la O/C Nro : ' . $numoc . ' para realizar la migracion Guia, por favor revisar');

            $this->redirect('../../fACORDENCOMPR/index.php', array(
                'model' => $model,
            ));
        } else {
            Yii::app()->user->setFlash('success', 'Se genero la Guia  satisfactoriamente');
            $model->IND_ESTA = '0';
            $this->render('Lista', array(
                'model' => $model,
            ));
        }
    }

    public function actionAdmin() {
        $model = new FACGUIAREMIS('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['FACGUIAREMIS']))
            $model->attributes = $_GET['FACGUIAREMIS'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionReporte($id) {
        $this->render('Reporte', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionFactura($id) {


        $usuario = Yii::app()->user->name;

        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_GUIA_TO_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $this->render('index', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function loadModel($id) {
        $model = FACGUIAREMIS::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'facguiaremis-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    function Estado($id) {

        $connection = Yii::app()->db;
        $sqlStatement = "SELECT IND_ESTA FROM fac_guia_remis F where COD_GUIA  = '" . $id . "';";
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

}

