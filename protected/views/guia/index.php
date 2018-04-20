<?php
/* @var $this GuiaController */
/* @var $model Guia */

$this->breadcrumbs = array(
    'Guia' => array('index'),
    'Administración',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#guia-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda Guía</h3>
        </div>
        <div class="mar">
            <?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
        </div>
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search', array(
                'model' => $model,
            )); ?>
        </div>
        <!-- search-form -->

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'post',
        ));
        ?>

        <div class="table-responsive">

            <?php
            $this->widget('ext.bootstrap.widgets.TbGridView', array(
                'id' => 'guia-grid',
                'type' => 'bordered condensed striped',
                'dataProvider' => $model->search(),
                'columns' => array(
                    array(
                        'id' => 'COD_GUIA',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    array(
                        'name' => 'COD_GUIA',
                        'htmlOptions' => array('style' => 'width: 80px;'),
                        'header' => 'N° Guía',
                        'value' => '$data->COD_GUIA',
                    ),
                    array(
                        'name' => 'COD_ORDE',
                        'header' => 'N° Orden',
                        'htmlOptions' => array('style' => 'width: 95px;'),
                        'value' => function ($data) {
                            $COD_ORDE = $data->__GET('COD_ORDE');
                            $Guia = GuiaController::ResultadoNOC($COD_ORDE);
                            return $Guia;
                        }
                    ),
                    array(
                        'name' => 'COD_TIEN',
                        'header' => 'Cliente - Tienda',
                        'htmlOptions' => array('style' => 'width: 190x;'),
                        'value' => function ($data) {
                            $tienda = $data->__GET('COD_TIEN');
                            $Tienda = GuiaController::ResultadoTienda($tienda);
                            return $Tienda;
                        }
                    ),
                    array(
                        'name' => 'FEC_EMIS',
                        'header' => 'Fecha Envio',
                        'htmlOptions' => array('style' => 'width: 110px;'),
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_EMIS))'
                    ),
                    array(
                        'name' => 'IND_ESTA',
                        'header' => 'Estado',
                        'htmlOptions' => array('style' => 'width: 165x;'),
                        'value' => function ($data) {
                            $valor = $data->__GET('IND_ESTA');
                            $estado = GuiaController::ResultadoEstado($valor);
                            return $estado;

                        },
                    ),
                    array(
                        'name' => 'IND_ESTA',
                        'header' => 'N° Factura',
                        'htmlOptions' => array('style' => 'width: 95x;'),
                        'value' => function ($data) {
                            $valor = $data->__GET('COD_GUIA');
                            $Factura = GuiaController::ResultadoFactura($valor);
                            return $Factura;
                        }
                    ),
                    array(
                        'header' => 'Opciones',
                        'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                        'htmlOptions' => array('style' => 'width: 130px; text-align: center;'),
                        'template' => '{view} / {update} / {Anular} / {Factura} / {Reporte}',
                        'buttons' => array(

                            'update' => array(
                                'icon' => 'pencil',
                                'label' => 'Actualizar Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/guia/update", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2 || id == 9){
                                        alert ('Este N° de Guia no puede ser actualizado debe estar en estado creado');
                                        return false
                                    }
                                     if (confirm ('¿ Estas Seguro de actualizar la Guia ?')){
                                            return true;
                                        }
                                            return false;
                                    
                               
                                }",
                            ),

                            'Anular' => array(
                                'icon' => 'trash',
                                'label' => 'Anular Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/guia/Anular", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2){
                                        alert ('Este N° de Guia no puede ser anulado debe estar en estado creado.');
                                        return false
                                    }
                                    if(id == 9 ){
                                        alert ('Este N° de Guia ya fue Anulado.');
                                        return false;
                                    }else{
                                     if (confirm ('¿Estas Seguro de Anular la Guia?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                            ),

                            'Reporte' => array(
                                'icon' => 'fa fa-file-pdf-o',
                                'label' => 'Generar PDF Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'options' => array('target' => '_blank'),
                                'url' => 'Yii::app()->controller->createUrl("/guia/reporte", array("id"=>$data->COD_GUIA))',
                            ),

                            'Factura' => array(
                                'icon' => 'fa fa-cog',
                                'label' => 'Generar Factura',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/guia/procesar", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 2 ||  id == 9){
                                        alert ('No puede generarse la Factura,la Guia debe estar en estado creado');
                                        return false
                                    }
                                    if(id == 1 ){
                                        alert ('Este N° de Guia ya fue generado su Factura, Por favor revisar.');
                                        return false;
                                    }else{
                                     if (confirm ('¿Estas seguro de generar la Factura para esta Guía?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                            ),
                        ),
                    ),
                ),
            ));
            ?>

            <div class="panel-footer " style="overflow:hidden;text-align:right;">
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-11">
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Refrescar Lista Guia',
                            'size' => 'default',
                            'icon' => 'refresh',
                            'buttonType' => 'link',
                            'url' => array('/guia/index')
                        ));
                        ?>
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => ' Imprimir Guias',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array('onclick' => 'doSomething(); return false;', 'target' => '_blank;'),
                            'url' => array('/guia/index')
                        ));
                        ?>
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => ' Imprimir Guias con Sistema Continuo',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array('onclick' => 'doSomething1(); return false;', 'target' => '_blank;'),
                            'url' => array('/guia/index')
                        ));
                        ?>
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Generar Guias a Facturas',
                            'size' => 'default',
                            'icon' => 'fa fa-cogs',
                            'buttonType' => 'submit',
                            'htmlOptions' => array('onclick' => 'return validation(1);'),
                            'url' => array('/guia/index')
                        ));
                        ?>
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Anulación Masiva',
                            'size' => 'default',
                            'icon' => 'fa fa-times',
                            'buttonType' => 'submit',
                            'htmlOptions' => array('onclick' => 'return validation(2);'),
                            'url' => array('/guia/index')
                        ));
                        ?>
                        <script>
                            function validation(code) {

                                var item = $("form input:checkbox:checked");
                                if (item.length === 0) {

                                    if (code === 1)
                                        alert('Debe seleccionar las Guías que requieren procesar a Factura ');
                                    else
                                        alert('Debe seleccionar las Guías que requieren anular ');
                                    return false;
                                }

                                if (!confirm('¿Estas Seguro de generar masivamente las Guías?, sólo se consideraran aquellas Guías en estado creado ')) {
                                    return false;
                                }

                                for (i = 0; i < item.length; i++) {

                                    if (code === 2) {
                                        $.ajax({
                                            url: 'guia/ajax',
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
                                            url: 'guia/ajax',
                                            dataType: "json",
                                            async: false,
                                            data: {
                                                type: 'id_guia_factu',
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

                        <script>
                            function doSomething() {

                                var item = $("form input:checkbox:checked");
                                if (item.length == 0) {
                                    alert('Debe seleccionar las Guías que requiere imprimir');
                                    return false;
                                }
                                idguia = '';
                                for (i = 0; i < item.length; i++) {
                                    if ((i + 1) == item.length) {//si es el ultimo elemento
                                        idguia = idguia + item[i].value;
                                    } else {
                                        if (item[i].value != '1') {
                                            idguia = idguia + item[i].value + '_';
                                        }
                                    }
                                }

                                hhref = 'guia/ajax?type=id_guia&id=' + idguia;
                                window.open(hhref, '_blank');
                                return false;
                            }
                        </script>
                        <script>
                            function doSomething1() {

                                var item = $("form input:checkbox:checked");
                                if (item.length == 0) {
                                    alert('Debe seleccionar las Guías    que requiere imprimir');
                                    return false;
                                }
                                idguia = '';
                                for (i = 0; i < item.length; i++) {
                                    if ((i + 1) == item.length) {//si es el ultimo elemento
                                        idguia = idguia + item[i].value;
                                    } else {
                                        if (item[i].value != '1') {
                                            idguia = idguia + item[i].value + '_';
                                        }
                                    }
                                }

                                hhref = 'guia/ajax2?type=id_guia&id=' + idguia;
                                window.open(hhref, '_blank');
                                return false;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endWidget(); ?>