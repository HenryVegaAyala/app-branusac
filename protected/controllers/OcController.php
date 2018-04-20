<?php

class OcController extends Controller
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view',
                    'delete', 'ClienteByTienda', 'ValorTienda', 'search',
                    'Ajax', 'Guia', 'Procesar', 'Reporte', 'Anular'),
                'users' => array('@'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new OC;

        if (isset($_POST['OC'])) {

            //variables de auditoria
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $ip = getenv("REMOTE_ADDR");
            $pc = @gethostbyaddr($ip);
            $pcip = $pc . ' - ' . $ip;

            $model->attributes = $_POST['OC'];
            $model->FEC_INGR = substr($model->FEC_INGR, 6, 4) . '/' . substr($model->FEC_INGR, 3, 2) . '/' . substr($model->FEC_INGR, 0, 2); //'2016-06-09' ;
            $model->FEC_ENVI = substr($model->FEC_ENVI, 6, 4) . '/' . substr($model->FEC_ENVI, 3, 2) . '/' . substr($model->FEC_ENVI, 0, 2); //'2016-06-09' ;
            $model->COD_ORDE = $model->au();
            $model->USU_DIGI = $usuario;

            if (isset($_POST['COD_PROD'])) {

                $CODPRO = $_POST['COD_PROD'];
                $DESCRI = $_POST['DES_LARG'];
                $UND = $_POST['NRO_UNID'];
                $VALPRE = $_POST['VAL_PREC'];
                $VALMOTUND = $_POST['VAL_MONT_UNID'];

                $count = Yii::app()->db->createCommand()->select('max(COD_ORDE)')
                    ->from('fac_orden_compr')
                    ->where("NUM_ORDE = '" . $model->NUM_ORDE . "' and COD_CLIE = '" . $model->COD_CLIE . "' and COD_TIEN = '" . $model->COD_TIEN . "';")
                    ->queryScalar();

                $id = ($count);

                if ($id > 0) {
                    Yii::app()->user->setFlash('error', 'La O/C ya ha sido ingresada para la relaciÃ³n cliente/tienda, por favor revisar');
                } else {
                    if ($model->save()) {
                        for ($i = 0; $i < count($CODPRO); $i++) {
                            if ($CODPRO[$i] !== '') {
                                $sqlStatement = "call PED_CREAR_DETAL_OC('" . $i . "',
                     '" . $model->COD_ORDE . "',
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
                Yii::app()->user->setFlash('error', 'Por lo menos debe ingresar un producto en la O/C');
            }
            Yii::app()->user->setFlash('success', 'Se genero la O/C satisfactoriamente.');
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['OC'])) {

            //variables de auditoria
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $ip = getenv("REMOTE_ADDR");
            $pc = @gethostbyaddr($ip);
            $pcip = $pc . ' - ' . $ip;

            $model->attributes = $_POST['OC'];

            if (strrpos($model->FEC_INGR, "/") > 0) {
                $model->FEC_INGR = substr($model->FEC_INGR, 6, 4) . '/' . substr($model->FEC_INGR, 3, 2) . '/' . substr($model->FEC_INGR, 0, 2); //'2016-06-09' ;
            }
            if (strrpos($model->FEC_ENVI, "/") > 0) {
                $model->FEC_ENVI = substr($model->FEC_ENVI, 6, 4) . '/' . substr($model->FEC_ENVI, 3, 2) . '/' . substr($model->FEC_ENVI, 0, 2); //'2016-06-09' ;
            }

            $model->USU_DIGI = $usuario;

            if (isset($_POST['COD_PROD'])) {

                $CODPRO = $_POST['COD_PROD'];
                $DESCRI = $_POST['DES_LARG'];
                $UND = $_POST['NRO_UNID'];
                $VALPRE = $_POST['VAL_PREC'];
                $VALMOTUND = $_POST['VAL_MONT_UNID'];

                $count = Yii::app()->db->createCommand()->select('count(*)')
                    ->from('fac_orden_compr')
                    ->where("NUM_ORDE = '" . $model->NUM_ORDE . "' and COD_CLIE = '" . $model->COD_CLIE . "' and COD_TIEN = '" . $model->COD_TIEN . "';")
                    ->queryScalar();

                $id = ($count);


                if ($model->update()) {
                    for ($i = 0; $i < count($CODPRO); $i++) {
                        if ($CODPRO[$i] <> '') {
                            $sqlStatement = "call PED_ACTUA_DETAL_OC('" . $i . "',
                     '" . $model->COD_ORDE . "',
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
                    $this->redirect(array('view', 'id' => $model->COD_ORDE));
                }
            } else {
                Yii::app()->user->setFlash('error', 'Por lo menos debe ingresar un producto en la O/C');
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model = new OC('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['OC']))
            $model->attributes = $_POST['OC'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OC the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = OC::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param OC $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'oc-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionClienteByTienda()
    {
        $COD = $_POST["OC"]["NUM_ORDE"];
        $list = Tienda::model()->findAll("COD_CLIE = ?", array($_POST["OC"]["COD_CLIE"]));
        echo "<option value=\"\">Seleccionar Tienda</option>";
        foreach ($list as $data)
            echo "<option value=\"{$data->COD_TIEN}\">{$data->DES_TIEN}</option>";

        Yii::app()->session['CODIGO'] = $COD;
    }

    public function actionValorTienda()
    {
        $clie = $_POST["OC"]["COD_CLIE"];
        $tienda = $_POST["OC"]["COD_TIEN"];

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

    public function actionAjax()
    {
        if ($_GET['type'] === 'id_sele') {
            $id = $_GET['id'];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_ANULA_OC ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();
        }

        if ($_GET['type'] === 'id_oc_tg') {
            $id = $_GET['id'];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = 'call PED_MIGRA_OC_TO_GUIA(:id ,:usuario,@out) ;';
            $command = $connection->createCommand($sqlStatement);

            $command->bindParam(':id', $id, PDO::PARAM_INT);
            $command->bindParam(':usuario', $usuario, PDO::PARAM_INT);

            $command->execute();
            $valueOut = $connection->createCommand('select @out as result;')->queryScalar();

            if ($valueOut === 0) {
                Yii::app()->user->setFlash('error', 'Hay O/C no procesadas por no tener productos asociados, por favor revisar');
            }
        }

        if ($_GET['type'] === 'produc_tiend') {
            $cliente = $_GET['clie'];
            $tienda = $_GET['tienda'];
            $row_num = $_GET['row_num'];
            $connection = Yii::app()->db;
            $sqlStatement = "SELECT DES_LARG,COD_PROD,NRO_UNID,GET_VALOR_PRODU(COD_PROD, '" . $tienda . "' ,'" . $cliente . "') VAL_PROD  FROM mae_produ where DES_LARG LIKE '" . strtoupper($_GET['nombre_producto']) . "%'";
            $command = $connection->createCommand($sqlStatement);
            $reader = $command->query();
            $data = array();
            while ($row = $reader->read()) {
                $name = $row['DES_LARG'] . '|' . $row['COD_PROD'] . '|' . $row['NRO_UNID'] . '|' . $row['VAL_PROD'] . '|' . $row_num;
                $data[] = $name;
            }

            echo json_encode($data);
        }
    }

    public function actionAnular($id)
    {
        $model = new OC('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['OC']))
            $model->attributes = $_POST['OC'];

        $connection = Yii::app()->db;
        $usuario = Yii::app()->user->name;
        $sqlStatement = "call PED_ANULA_OC ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        $this->render('index', array(
            'model' => $model,
        ));
    }


    function ResultadoFact($id)
    {
        $model = new OC();

        $out = $model->getFactura($id);

        if ($out != '') {
            return $out;
        } else {
            return "Sin Factura";
        }
    }

    function ResultadoGuia($id)
    {
        $model = new OC();

        $out = $model->getGuia($id);

        if ($out != '') {
            return $out;
        } else {
            return "Sin Guia";
        }
    }

    function ResultadoOc($id)
    {
        $model = new OC();

        $out = $model->getOC($id);

        if ($out != '') {
            return $out;
        } else {
            return "Sin O.C";
        }
    }

    public function actionReporte($id)
    {
        $this->render('reporte', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionProcesar($id)
    {
        $model = new OC('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['OC']))
            $model->attributes = $_POST['OC'];

        $usuario = Yii::app()->user->name;
        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_OC_TO_GUIA (:id ,:usuario,@out) ;";
        $command = $connection->createCommand($sqlStatement);
        $numoc = $_GET['id'];
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $command->bindParam(":usuario", $usuario, PDO::PARAM_INT);
        $command->execute();
        $valueOut = $connection->createCommand("select @out as result;")->queryScalar();

        if ($valueOut == 0) {

            Yii::app()->user->setFlash('error', 'Por lo menos debe ingresar un producto en la O/C Nro : ' . $this->ResultadoOc($numoc) . ' para realizar la migracion Guia, por favor revisar');
            $this->render('index', array(
                'model' => $model,
            ));

        } else {

            Yii::app()->user->setFlash('success', 'El N° de O.C - '. $this->ResultadoOc($numoc).', genero el N° de Guía - ' .$this->ResultadoGuia($numoc) . ' satisfactoriamente '."");
            $this->render('index', array(
                'model' => $model,
            ));
        }

    }


}
