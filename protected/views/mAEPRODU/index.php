<?php
/* @var $this MAEPRODUController */
/* @var $model MAEPRODU */

$this->breadcrumbs = array(
    'Productos',
);
?>


<?php
$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'id' => 'maeprodu-grid',
    'type' => 'bordered condensed striped',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'COD_PROD',
//        'COD_LINE',
        'DES_LARG',
//        'DES_CORT',
//        'COD_ESTA',
        'COD_MEDI',
//        'VAL_PESO',
//        'VAL_PROD',
//        'VAL_CONV',
//        'VAL_PORC',
//        'VAL_COST',
//        'VAL_REPO',
//        'COD_LOTE',
//        'USU_DIGI',
//        'FEC_DIGI',
//        'USU_MODI',
//        'FEC_MODI',
//        array(
//            'header' => 'Opciones',
//            'class' => 'ext.bootstrap.widgets.TbButtonColumn',
//            'htmlOptions' => array('style' => 'width: 77px; text-align: center;'),
//            'template' => '{update}',
//        ),
        array(
            'header' => 'Opción',
            'class' => 'ext.bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px; text-align: center;'),
//            'template' => '{view}{update}{delete}{migrar}',
            'template' => '{update}{migrar}',
            'buttons' => array(
                'migrar' => array(
                    'icon' => 'CHECK',
                    'htmlOptions' => array('style' => 'width: 50px'),
                    'url' => 'Yii::app()->controller->createUrl("/Presupuesto/migrar", array("id"=>$data->COD_PROD))',
                ),
            ),
        ),
    ),
));
?>
<br>