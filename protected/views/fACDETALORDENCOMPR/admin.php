<?php

$this->widget('ext.bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'facdetalordencompr-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'header' => 'Codigo',
            'value' => '$data->COD_PROD'),
        array(
            'header' => 'Descripción',
            'value' => '$data->cODPROD->DES_LARG'),
        array(
            'header' => 'Cantidad',
            'value' => '$data->NRO_UNID'),
        array(
            'header' => 'Precio',
            'value' => '$data->VAL_PREC'),
        array(
            'header' => 'Total',
            'value' => '$data->VAL_TOTAL'),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Quitar',
            'deleteButtonUrl' => 'Yii::app()->createUrl("FACDETALORDENCOMPR/delete",array("id"=>$data["ORD_COR"]))',
            'template' => '{delete}',
        )
    ),
));
?>