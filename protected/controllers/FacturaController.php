<?php

class FacturaController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated 
                'actions' => array('create', 'update', 'index', 'view',
                    'admin', 'delete', 'Anular', 'Reporte', 'ValorTienda', 'ClienteByTienda',
                    'Ajax', 'Ajax1', 'Ajax2', 'Procesar'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate()
    {
        $model = new Factura();

        if (isset($_POST['Factura'])) {

            //variables de auditoria
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $ip = getenv("REMOTE_ADDR");
            $pc = @gethostbyaddr($ip);
            $pcip = $pc . ' - ' . $ip;

            $model->attributes = $_POST['Factura'];
            $model->FEC_PAGO = substr($model->FEC_PAGO, 6, 4) . '/' . substr($model->FEC_PAGO, 3, 2) . '/' . substr($model->FEC_PAGO, 0, 2); //'2016-06-09' ;
            $model->COD_FACT = $model->au();
            $model->USU_DIGI = $usuario;
            $model->IND_ESTA = 0;


            if (isset($_POST['COD_PROD'])) {

                $CODPRO = $_POST['COD_PROD'];
                $DESCRI = $_POST['DES_LARG'];
                $UND = $_POST['NRO_UNID'];
                $VALPRE = $_POST['VAL_PREC'];
                $VALMOTUND = $_POST['VAL_MONT_UNID'];

                $max = Yii::app()->db->createCommand()->select('COD_FACT')
                    ->from('fac_factu')
                    ->where("COD_FACT = '" . $model->COD_FACT . "' and COD_CLIE = '" . $model->COD_CLIE . "' and COD_TIEN = '" . $model->COD_TIEN . "';")
                    ->queryScalar();

                $id = ($max);

                if ($id > 0) {
                    Yii::app()->user->setFlash('error', 'La Factura ya ha sido ingresada para la relación cliente/tienda, por favor revisar');
                } else {
                    if ($model->save()) {
                        for ($i = 0; $i < count($CODPRO); $i++) {
                            if ($CODPRO[$i] <> '') {
                                $sqlStatement = "call PED_CREAR_DETAL_FACT('" . $i . "',
                     '" . $model->COD_FACT . "',
                     '" . $model->COD_TIEN . "',
                     '" . $model->COD_CLIE . "',
                     '" . $CODPRO[$i] . "',
                     '" . $UND[$i] . "',
                     '" . $VALPRE[$i] . "',
                     '" . $VALMOTUND[$i] . "',
                     '" . $DESCRI[$i] . "',
                     '" . $usuario . "',
                     '" . $pcip . "')";
                                $command = $connection->createCommand($sqlStatement);
                                $command->execute();
                            }
                        }
                        $this->redirect(array('index'));
                    }
                }
            } else {
                Yii::app()->user->setFlash('error', 'Por lo menos debe ingresar un producto en la Factura');
            }
            Yii::app()->user->setFlash('success', 'Se genero la Factura satisfactoriamente.');
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Factura'])) {

            //variables de auditoria
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $ip = getenv("REMOTE_ADDR");
            $pc = @gethostbyaddr($ip);
            $pcip = $pc . ' - ' . $ip;

            $model->attributes = $_POST['Factura'];

            $model->FEC_PAGO = substr($model->FEC_PAGO, 6, 4) . '/' . substr($model->FEC_PAGO, 3, 2) . '/' . substr($model->FEC_PAGO, 0, 2); //'2016-06-09'
            $model->USU_DIGI = $usuario;

            if (isset($_POST['COD_PROD'])) {

                $CODPRO = $_POST['COD_PROD'];
                $DESCRI = $_POST['DES_LARG'];
                $UND = $_POST['NRO_UNID'];
                $VALPRE = $_POST['VAL_PREC'];
                $VALMOTUND = $_POST['VAL_MONT_UNID'];

                $max = Yii::app()->db->createCommand()->select('COD_FACT')
                    ->from('fac_factu')
                    ->where("COD_FACT = '" . $model->COD_FACT . "' and COD_CLIE = '" . $model->COD_CLIE . "' and COD_TIEN = '" . $model->COD_TIEN . "';")
                    ->queryScalar();

                $id = ($max);

                if ($model->update()) {
                    for ($i = 0; $i < count($CODPRO); $i++) {
                        if ($CODPRO[$i] <> '') {
                            $sqlStatement = "call PED_ACTUA_DETAL_FACT('" . $i . "',
                     '" . $model->COD_FACT . "',
                     '" . $model->COD_TIEN . "',
                     '" . $model->COD_CLIE . "',
                     '" . $CODPRO[$i] . "',
                     '" . $UND[$i] . "',
                     '" . $VALPRE[$i] . "',
                     '" . $VALMOTUND[$i] . "',
                     '" . $DESCRI[$i] . "',
                     '" . $usuario . "',
                     '" . $pcip . "')";
                            $command = $connection->createCommand($sqlStatement);
                            $command->execute();
                        }
                    }
                    $this->redirect(array('view', 'id' => $model->COD_FACT));
                }
            } else {
                Yii::app()->user->setFlash('error', 'Por lo menos debe ingresar un producto en la Factura');
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex()
    {
        $model = new Factura('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Factura']))
            $model->attributes = $_GET['Factura'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = Factura::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'factura-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionValorTienda()
    {
        $clie = $_POST["Factura"]["COD_CLIE"];
        $tienda = $_POST["Factura"]["COD_TIEN"];

        $connection = Yii::app()->db;
        $sqlStatement = "Select MC.NRO_RUC,MC.DES_CLIE,MT.DIR_TIEN from mae_clien MC, mae_tiend MT where  MC.COD_CLIE = MT.COD_CLIE and MT.COD_ESTA = 1 and MC.COD_ESTA = 1 and MC.COD_CLIE = $clie and MT.COD_TIEN = $tienda;";
        $command = $connection->createCommand($sqlStatement);
        $reader = $command->query();

        foreach ($reader as $row)
            echo $row['NRO_RUC'];
        echo "/";
        echo $row['DES_CLIE'];
        echo "/";
        echo $row['DIR_TIEN'];
    }

    public function actionClienteByTienda()
    {
        $list = Tienda::model()->findAll("COD_CLIE = ?", array($_POST["Factura"]["COD_CLIE"]));
        echo "<option value=\"\">Seleccionar Tienda</option>";
        foreach ($list as $data)
            echo "<option value=\"{$data->COD_TIEN}\">{$data->DES_TIEN}</option>";
    }

    public function actionAjax()
    {

        if ($_GET['type'] == 'id_guia_factu') {
            $id = $_GET["id"];
            $usuario = Yii::app()->user->name;
            $connection = Yii::app()->db;
            $sqlStatement = "call PED_MIGRA_FACTU_TO_GUIA('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();

        }

        if ($_GET['type'] == 'produc_tiend') {
            $cliente = $_GET["clie"];
            $tienda = $_GET["tienda"];
            $row_num = $_GET['row_num'];
            $connection = Yii::app()->db;
            $sqlStatement = "SELECT DES_LARG,COD_PROD,NRO_UNID,GET_VALOR_PRODU(COD_PROD, '" . $tienda . "' ,'" . $cliente . "') VAL_PROD  FROM mae_produ where DES_LARG LIKE '" . strtoupper($_GET['nombre_producto']) . "%'";
            $command = $connection->createCommand($sqlStatement);
            $reader = $command->query();
            $data = array();
            while ($row = $reader->read()) {
                $name = $row['DES_LARG'] . '|' . $row['COD_PROD'] . '|' . $row['NRO_UNID'] . '|' . $row['VAL_PROD'] . '|' . $row_num;
                array_push($data, $name);
            }
            echo json_encode($data);
        }
    }

    function ResultadoOc($id)
    {
        $model = new Factura();

        $out = $model->getOc($id);

        if ($out != '') {
            return $out;
        } else {
            return "Sin Presupuesto";
        }
    }

    function ResultadoGuia($id)
    {
        $model = new Factura();

        $out = $model->getGuia($id);

        if ($out != '') {
            return $out;
        } else {
            return "Sin Guía";
        }
    }

    public function actionReporte($id)
    {
        $this->render('reporte', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionAnular($id)
    {
        $model = new Factura('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['Factura']))
            $model->attributes = $_POST['Factura'];

        $connection = Yii::app()->db;
        $usuario = Yii::app()->user->name;
        $sqlStatement = "call PED_ANULA_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        //$model->IND_ESTA = '9';
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionAjax1()
    {
        if ($_GET['type'] == 'id_sele') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_ANULA_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();
            $this->renderPartial('index');
        }

        if ($_GET['type'] == 'id_factu') {
            $id = $_GET["id"];
            $idfactu = explode("_", $id);

            $this->renderPartial('/Reporte/_ReporteFactura', array(
                'idfactu' => $idfactu,));

        }
    }

    public function actionAjax2()
    {
        if ($_GET['type'] == 'id_factu') {
            $id = $_GET["id"];
            $idfactu = explode("_", $id);

            $this->renderPartial('/Reporte/_ReporteFacturaContinuo', array(
                'idfactu' => $idfactu,));
        }
    }

    function ResultadoFecha($fecha)
    {
        if ($fecha == null) {
            echo 'Fecha Indefinida';
        } else {
            echo Yii::app()->dateFormatter->format("dd/MM/y", strtotime($fecha));
        }
    }

    function ResultadoEstado($Estado)
    {
        switch ($Estado) {
            case 1:
                return 'Emitida/Pendiente de Cobro';
                break;
            case 2:
                return 'Cobrada/Cerrada';
                break;
            case 9:
                echo 'Anulado';
                return;
            case 0:
                return 'Creado';
                break;
        }
    }

    public function actionProcesar($id)
    {
        $model = new Factura('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['Factura']))
            $model->attributes = $_POST['Factura'];

        $usuario = Yii::app()->user->name;
        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_FACTU_TO_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        Yii::app()->user->setFlash('success', "Se genero la Guia satisfactoriamente.");
        $this->render('index', array(
            'model' => $model,
        ));
    }

}
