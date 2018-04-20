<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    /*
      'COD_PROD',
      'COD_LINE',
      'DES_LARG',
      'DES_CORT',
      'COD_ESTA',
      'COD_MEDI',
      'VAL_PESO',
      'VAL_PROD',
      'VAL_CONV',
      'VAL_PORC',
      'VAL_COST',
      'VAL_REPO',
      'COD_LOTE',
      'USU_DIGI',
      'FEC_DIGI',
      'USU_MODI',
      'FEC_MODI',
     */
    'type' => 'striped bordered condensed',
    'id' => 'maeprodu-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'id_tvista',
            'header' => 'Linea',
            'value' => '$data->COD_PROD'),
        array(
            'name' => 'cantidad',
            'header' => 'Cantidad',
            'value' => '$data->DES_LARG'),
        array(
            'name' => 'descripcion',
            'header' => 'Descripción',
            'value' => '$data->'),
        array(
            'name' => 'precio_unitario',
            'header' => 'Precio Unitario',
            'value' => '$data->precio_unitario'),
        array(
            'name' => 'total',
            'header' => 'Total',
            'value' => '$data->total'),
//        array(
//            'class' => 'CButtonColumn',
//            'header' => 'Quitar',
//            'deleteButtonUrl' => 'Yii::app()->createUrl("TempProducto/delete",array("id"=>$data["n_presu"]))',
//            'template' => '{delete}',
//        )
    ),
));
?>