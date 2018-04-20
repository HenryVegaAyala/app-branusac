<?php
/* @var $this ParametroController */
/* @var $model Parametro */

$this->breadcrumbs = array(
    'Parametro' => array('index'),
    'Administración de Recursos',
);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Configuración</h3>
    </div>


    <div class="table-responsive">
        <?php $this->widget('ext.bootstrap.widgets.TbGridView', array(
            'id' => 'parametro-grid',
            'type' => 'bordered condensed striped',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => 'COD_PARA',
                    'header' => 'N°',
                    'htmlOptions' => array('style' => 'width: 20px'),
                    'value' => '$data->COD_PARA'
                ),
                array(
                    'name' => 'VAL_PARA',
                    'header' => 'Valor del actual del I.G.V',
                    'htmlOptions' => array('style' => 'width: 140px'),
                    'value' => '$data->VAL_PARA'
                ),
                array(
                    'name' => 'DES_PARA',
                    'header' => 'Descripción',
                    'htmlOptions' => array('style' => 'width: 140px'),
                    'value' => '$data->DES_PARA'
                ),
                array(
                    'name' => 'USU_MODI',
                    'header' => 'Usuario Modificado',
                    'htmlOptions' => array('style' => 'width: 140px'),
                    'value' => 'strtoupper($data->USU_MODI)'
                ),
                array(
                    'name' => 'FEC_MODI',
                    'header' => 'Fecha Modificada',
                    'htmlOptions' => array('style' => 'width: 140px'),
                    'value' => function ($data) {

                        $variable = $data->__GET('FEC_MODI');

                        if ($variable == null)
                            echo '';
                        else
                            echo Yii::app()->dateFormatter->format("dd/MM/y hh:mm:ss a", strtotime($data->FEC_MODI));
                    },
                ),
                array(
                    'header' => 'Opciones',
                    'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                    'htmlOptions' => array('style' => 'width: 100px; text-align: center;'),
                    'template' => '{update} ',
                ),
            ),
        )); ?>
    </div>
    <div class="panel-footer " style="overflow:hidden;text-align:right;">
        <div class="form-group">
            <div class="col-sm-12">

                <?php
                $this->widget(
                    'ext.bootstrap.widgets.TbButton', array(
                    'context' => 'default',
                    'label' => 'Refrescar Lista',
                    'size' => 'default',
                    'icon' => 'refresh',
                    'buttonType' => 'link',
                    'url' => array('/parametro/index')
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<br>