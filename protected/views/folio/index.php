<?php
/* @var $this FolioController */
/* @var $model Folio */

$this->breadcrumbs = array(
    'Numeración' => array('index'),
    'Administración de Recursos',
);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Configuración</h3>
    </div>


    <div class="table-responsive">
        <?php $this->widget('ext.bootstrap.widgets.TbGridView', array(
            'id' => 'folio-presu-grid',
            'type' => 'bordered condensed striped',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'name' => 'VAL_LLAVE',
                    'header' => 'N°',
                    'htmlOptions' => array('style' => 'width: 30px'),
                    'value' => '$data->VAL_LLAVE'
                ),
                array(
                    'name' => 'VAL_ACTU',
                    'header' => 'Valor de la numeración',
                    'htmlOptions' => array('style' => 'width: 200px'),
                    'value' => '$data->VAL_ACTU'
                ),
                array(
                    'name' => 'DESCRIPCION',
                    'header' => 'Descripción',
                    'htmlOptions' => array('style' => 'width: 300px'),
                    'value' => '$data->DESCRIPCION'
                ),
                array(
                    'name' => 'USUARIO',
                    'header' => 'Usuario Modificado',
                    'value' => 'strtoupper($data->USUARIO)'
                ),
                array(
                    'name' => 'FECHA',
                    'header' => 'Fecha Modificada',
                    'htmlOptions' => array('style' => 'width: 190px'),
                    'value' => function ($data) {

                        $variable = $data->__GET('FECHA');

                        if ($variable == null)
                            echo '';
                        else
                            echo Yii::app()->dateFormatter->format("dd/MM/y hh:mm:ss a", strtotime($data->FECHA));
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
                    'url' => array('/folio/index')
                ));
                ?>
            </div>
        </div>
    </div>
</div>
<br>