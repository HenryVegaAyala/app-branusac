<?php

class GuiaController extends Controller
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
                'actions' => array('update', 'index', 'view', 'delete', 'Procesar', 'Anular',
                    'Ajax', 'Ajax2', 'Factura', 'Reporte', 'Anulado'),
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

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Guia'])) {
            $model->attributes = $_POST['Guia'];

            if (strrpos($model->FEC_EMIS, "/") > 0) {
                $model->FEC_EMIS = substr($model->FEC_EMIS, 6, 4) . '/' . substr($model->FEC_EMIS, 3, 2) . '/' . substr($model->FEC_EMIS, 0, 2); //'2016-06-09' ;
            }

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->COD_GUIA));
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
        $model = new Guia('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Guia']))
            $model->attributes = $_GET['Guia'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = Guia::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'guia-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    function ResultadoOC($id)
    {
        $model = new Guia();

        $out = $model->getOc($id);

        if ($out != '') {
            return $out;
        } else {
            return "Sin Guia";
        }
    }

    function ResultadoNOC($oc)
    {
        $model = new Guia();
        $out = $model->GetGuia($oc);
        if ($out == null) {
            return "Sin Presupuesto";
        } else {
            return $out;
        }
    }

    function ResultadoTienda($tienda)
    {
        $model = new Guia();
        $out = $model->GetTienda($tienda);
        if ($out == null) {
            return "Sin Tienda";
        } else {
            return $out;
        }
    }

    function ResultadoCliente($Cliente)
    {
        $model = new Guia();
        $out = $model->GetCliente($Cliente);
        if ($out == null) {
            return "Sin Cliente";
        } else {
            return $out;
        }
    }

    function ResultadoFactura($factura)
    {
        $model = new Guia();
        $out = $model->GetFactura($factura);
        if ($out == null) {
            return "Sin Factura";
        } else {
            return $out;
        }
    }

    function ResultadoEstado($estado)
    {
        switch ($estado) {
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

    public function actionReporte($id)
    {
        $this->render('reporte', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionProcesar($id)
    {
        $model = new Guia('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['Guia']))
            $model->attributes = $_POST['Guia'];

        $usuario = Yii::app()->user->name;
        $connection = Yii::app()->db;
        $sqlStatement = "call PED_MIGRA_GUIA_TO_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        // $model->IND_ESTA = '1';

        Yii::app()->user->setFlash('success', "Se genero la Factura satisfactoriamente.");
        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionAnular($id)
    {
        $model = new Guia('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_POST['Guia']))
            $model->attributes = $_POST['Guia'];

        $connection = Yii::app()->db;
        $usuario = Yii::app()->user->name;
        $sqlStatement = "call PED_ANULA_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
        $command = $connection->createCommand($sqlStatement);
        $command->execute();

        //$model->IND_ESTA = '9';

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionAjax()
    {
        if ($_GET['type'] == 'id_sele') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_ANULA_GUIA ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();

        }

        if ($_GET['type'] == 'id_guia_factu') {
            $id = $_GET["id"];
            $connection = Yii::app()->db;
            $usuario = Yii::app()->user->name;
            $sqlStatement = "call PED_MIGRA_GUIA_TO_FACTU ('" . $id . "' ,'" . $usuario . "') ;";
            $command = $connection->createCommand($sqlStatement);
            $command->execute();

        }

        if ($_GET['type'] == 'id_guia') {
            $id = $_GET["id"];
            $idguia = explode("_", $id);

            $this->renderPartial('/Reporte/_ReporteGuia', array(
                'idguia' => $idguia,));
        }
    }

    public function actionAjax2() {

        if ($_GET['type'] == 'id_guia') {
            $id = $_GET["id"];
            $idguia = explode("_", $id);

            $this->renderPartial('/Reporte/_ReporteGuiaContinuo', array(
                'idguia' => $idguia,));
        }
    }

}
