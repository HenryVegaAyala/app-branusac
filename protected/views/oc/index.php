<?php
/* @var $this OCController */
/* @var $model OC */

$this->pageTitle = 'Lista de Presupuesto';
$this->breadcrumbs = array(
    'Presupuesto.' => array('index'),
    'Administración',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#oc-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'post',
));
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Búsqueda Presupuesto</h3>
    </div>

    <!-- Mensajes flash-->

    <?php if (Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div>
    <?php endif ?>

    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif ?>


    <div class="mar">
        <?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
    </div>
    <div class="search-form" style="display:none">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
    </div>
    <!-- search-form -->

    <div class="table-responsive">
        <?php
        $this->widget('ext.bootstrap.widgets.TbGridView', array(
            'id' => 'oc-grid',
            'type' => 'bordered condensed striped',
            'dataProvider' => $model->search(),
            'columns' => array(
                array(
                    'id' => 'COD_ORDE',
                    'class' => 'CCheckBoxColumn',
                    'selectableRows' => '50',
                ),
                'NUM_ORDE',
                array(
                    'name' => 'COD_TIEN',
                    'header' => 'Tienda',
                    'value' => function ($data) {
                        $model = new OC();
                        $variable = $data->__GET('COD_TIEN');
                        echo $model->getTienda($variable);
                    },
                ),
                array(
                    'name' => 'FEC_INGR',
                    'header' => 'Fecha de Ingreso',
                    'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_INGR))'
                ),
                array(
                    'name' => 'FEC_ENVI',
                    'header' => 'Fecha de Envio',
                    'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_ENVI))'
                ),
                'TOT_FACT',
                array(
                    'name' => 'IND_ESTA',
                    'header' => 'Estado',
                    'value' => function ($data) {

                        $variable = $data->__GET('IND_ESTA');
                        switch ($variable) {
                            case 1:
                                echo 'En Proceso';
                                break;
                            case 2:
                                echo 'Despacho/Atendido';
                                break;
                            case 9:
                                echo 'Anulado';
                                break;
                            case 0:
                                echo 'Creado';
                                break;
                        }
                    },
                ),
                array(
                    'name' => 'COD_TIEN',
                    'header' => 'N° de Guia',
                    'value' => function ($data) {
                        $model = new OC();
                        $variable = $data->__GET('COD_ORDE');
                        echo $model->getGuia($variable);
                    }
                ),
                array(
                    'name' => 'COD_TIEN',
                    'header' => 'N° de Factura',
                    'value' => function ($data) {
                        $model = new OC();
                        $variable = $data->__GET('COD_ORDE');
                        echo $model->getFactura($variable);
                    }
                ),
                array(
                    'header' => 'Opciones',
                    'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                    'htmlOptions' => array('style' => 'width: 130px; text-align: center;'),
                    'template' => '{view} / {update} / {Anular} / {Guia} / {Reporte}',
                    'buttons' => array(

                        'update' => array(
                            'icon' => 'pencil',
                            'label' => 'Actualizar Presupuesto',
                            'htmlOptions' => array('style' => 'width: 50px'),
                            'url' => 'Yii::app()->controller->createUrl("/oc/update", array("id"=>$data->COD_ORDE,"est"=>$data->IND_ESTA))',
                            'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2 || id == 9){
                                        alert ('Este N° de presupuesto no puede ser actualizado debe tener el estado creado.');
                                        return false
                                    }
                                     if (confirm ('¿Estas seguro de actualizar el Presupuesto?')){
                                            return true;
                                        }
                                            return false;
                                    
                               
                                }",
                        ),

                        'Anular' => array(
                            'icon' => 'trash',
                            'label' => 'Anular Presupuesto',
                            'htmlOptions' => array('style' => 'width: 50px'),
                            'url' => 'Yii::app()->controller->createUrl("/oc/Anular", array("id"=>$data->COD_ORDE,"est"=>$data->IND_ESTA))',
                            'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2){
                                        alert ('Este N° de O/C no puede ser anulado debe estar en estado creado');
                                        return false
                                    }
                                    if(id == 9 ){
                                        alert ('Este N° de presupuesto ya fue anulado.');
                                        return false;
                                    }else{
                                     if (confirm ('¿Estas seguro de anular este N° de Presupuesto?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                        ),

                        'Guia' => array(
                            'icon' => 'fa fa-cog',
                            'label' => 'Generar Guia',
                            'htmlOptions' => array('style' => 'width: 50px'),
//                                'visible' => 'array("$data->IND_ESTA") < 1',
                            'url' => 'Yii::app()->controller->createUrl("/oc/procesar", array("id"=>$data->COD_ORDE,"est"=>$data->IND_ESTA))',
                            'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);

                                    if(id == 2 ||  id == 9){
                                        alert ('No puede generarse la Guía, el presupuesto debe estar en su estado creado.');
                                        return false
                                    }
                                    if(id == 1 ){
                                        alert ('En este N° de presupuesto ya fue generado su Guía, Por Favor revisar.');
                                        return false;
                                    }else{
                                     if (confirm ('¿Estas seguro de generar la Guía para este presupuesto ?')){
                                            return true;
                                        }
                                            return false;
                                    }

                                }",
                        ),

                        'Reporte' => array(
                            'icon' => 'fa fa-file-pdf-o',
                            'label' => 'Generar PDF',
                            'htmlOptions' => array('style' => 'width: 50px'),
                            'options' => array('target' => '_blank'),
                            'url' => 'CHtml::normalizeUrl(array("reporte", "id"=>$data->COD_ORDE))',
                        ),
                    ),
                ),
            ),
        ));
        ?>


    </div>

    <div class="panel-footer " style="overflow:hidden;text-align:right;">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php
                $this->widget(
                    'ext.bootstrap.widgets.TbButton', array(
                    'context' => 'default',
                    'label' => 'Refrescar Lista de Presupuesto',
                    'size' => 'default',
                    'icon' => 'refresh',
                    'buttonType' => 'link',
                    'url' => array('/oc/index')
                ));
                ?>

                <?php
                $this->widget(
                    'ext.bootstrap.widgets.TbButton', array(
                    'context' => 'default',
                    'label' => 'Generar Guía Masiva',
                    'size' => 'default',
                    'icon' => 'fa fa-cogs',
                    'htmlOptions' => array('onclick' => 'return validation(1);'),
                    'buttonType' => 'submit',
                ));
                ?>

                <?php
                $this->widget(
                    'ext.bootstrap.widgets.TbButton', array(
                    'context' => 'default',
                    'label' => 'Anulación Masiva',
                    'size' => 'default',
                    'icon' => 'fa fa-times',
                    'htmlOptions' => array('onclick' => 'return validation(2);'),
                    'buttonType' => 'submit',
                ));
                ?>

                <script>
                    function validation(code) {

                        var item = $("form input:checkbox:checked");
                        if (item.length == 0) {
                            if (code == 1)
                                alert('Debe seleccionar el presupuesto que requiere procesar ');
                            else
                                alert('Debe seleccionar el presupuesto que requiere anular ');
                            return false;
                        }
                        if (!confirm('¿Estas seguro de usar la opción masiva de las Guías?, Sólo se consideraran aquellos presupuestos en estado creado.')) {
                            return false;
                        }

                        for (i = 0; i < item.length; i++) {

                            if (code === 2) {
                                $.ajax({
                                    url: 'oc/ajax',
                                    dataType: "json",
                                    async: false,
                                    data: {
                                        type: 'id_sele',
                                        id: item[i].value
                                    },
                                    succes: function (data) {

                                        response($.map(data, function (item) {

                                            return {
                                                label: item,
                                                value: item,
                                                data: item
                                            }
                                        }));


                                    }
                                });
                            } else {
                                $.ajax({
                                    url: 'oc/ajax',
                                    dataType: "json",
                                    async: false,
                                    data: {
                                        type: 'id_oc_tg',
                                        id: item[i].value
                                    },
                                    succes: function (data) {

                                        response($.map(data, function (item) {

                                            return {
                                                label: item,
                                                value: item,
                                                data: item
                                            }
                                        }));


                                    }
                                });
                            }
                        }

                        return true;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<!-- search-form -->