<?php
/* @var $this FacturaController */
/* @var $model Factura */


$this->breadcrumbs = array(
    'Factura' => array('index'),
    'Administración',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#factura-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda Factura</h3>
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
                'id' => 'facfactu-grid',
                'type' => 'bordered condensed striped',
                'id' => 'factura-grid',
                'dataProvider' => $model->search(),
                'columns' => array(
                    array(
                        'id' => 'COD_FACT',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    array(
                        'name' => 'COD_FACT',
                        'header' => 'N° Factura',
                        'value' => '$data->COD_FACT'
                    ),
                    /* array(
                         'name' => 'COD_CLIE',
                         'header' => 'Cliente',
                         'value' => function ($data) {
                             $model = new Factura();
                             $variable = $data->__GET('COD_TIEN');
                             echo $model->getCliente($variable);
                         },
                     ),*/
                    array(
                        'name' => 'FEC_FACT',
                        'header' => 'Fecha de Factura',
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_FACT))'
                    ),
                    array(
                        'name' => 'FEC_PAGO',
                        'header' => 'Fecha de Pago',
                        'value' => function ($data) {
                            $variable = $data->__GET('FEC_PAGO');
                            $Fecha = FacturaController::ResultadoFecha($variable);
                            return $Fecha;
                        },
                    ),
                    array(
                        'name' => 'IND_ESTA',
                        'header' => 'Estado',
                        'value' => function ($data) {
                            $variable = $data->__GET('IND_ESTA');
                            $estado = FacturaController::ResultadoEstado($variable);
                            return $estado;
                        },
                    ),
                    array(
                        'name' => 'COD_GUIA',
                        'header' => 'N° Guia',
                        'value' => function ($data) {
                            $NGuia = $data->__GET('COD_GUIA');
                            $Guia = FacturaController::ResultadoGuia($NGuia);
                            return $Guia;
                        }
                    ),
                    array(
                        'name' => 'COD_GUIA',
                        'header' => 'N° O/C',
                        'value' => function ($data) {
                            $Guia = $data->__GET('COD_FACT');
                            $OC = FacturaController::ResultadoOc($Guia);
                            return $OC;
                        }
                    ),

                    'TOT_FACT',

                    array(
                        'header' => 'Opciones',
                        'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                        'htmlOptions' => array('style' => 'width: 125px; text-align: center;'),
                        'template' => '{view} / {update} / {Anular} / {Guia} / {Reporte}',
                        'buttons' => array(

                            'update' => array(
                                'icon' => 'pencil',
                                'label' => 'Actualizar Factura',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/factura/update", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 2 || id == 9){
                                        alert ('Este N° de Factura no puede ser actualizado debe estar en estado creado');
                                        return false
                                    }
                                     if (confirm ('¿ Estas Seguro de actualizar la Factura ?')){
                                            return true;
                                        }
                                            return false;
                                    
                               
                                }",
                            ),

                            'Anular' => array(
                                'icon' => 'trash',
                                'label' => 'Anular Factura',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/factura/Anular", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 2){
                                        alert ('Este N° de Factura no puede ser anulado debe estar en estado emitido');
                                        return false
                                    }
                                    if(id == 9 ){
                                        alert ('Este N° de Factura ya fue Anulado');
                                        return false;
                                    }else{
                                     if (confirm ('¿ Estas Seguro de Anular la Factura ?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                            ),

                            'Reporte' => array(
                                'icon' => 'fa fa-file-pdf-o',
                                'label' => 'Generar PDF Factura',
                                'htmlOptions' => array('style' => 'width: 50px',),
                                'options' => array('target' => '_blank'),
                                'url' => 'Yii::app()->controller->createUrl("/factura/reporte", array("id"=>$data->COD_FACT))',
                            ),

                            'Guia' => array(
                                'icon' => 'fa fa-cog',
                                'label' => 'Generar Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/factura/procesar", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);

                                    if(id == 2 ||  id == 9){
                                        alert ('No puede generarse la Guía,la Factura debe estar en estado creado');
                                        return false
                                    }
                                    if(id == 1 ){
                                        alert ('Este N° de Factura ya fue generado su Guía, Por favor revisar.');
                                        return false;
                                    }else{
                                     if (confirm ('¿Estas seguro de generar la Guía para esta Factura?')){
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
            <div class="panel-footer">

                <div class="btn-toolbar btn-group-sm" role="toolbar">

                    <div class="btn-group">
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Refrescar Lista Facturas',
                            'size' => 'default',
                            'icon' => 'refresh',
                            'buttonType' => 'link',
                            'url' => array('/factura/index')
                        ));
                        ?>
                    </div>

                    <div class="btn-group">
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Imprimir Facturas',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array(
                                'onclick' => 'doSomething(); return false;',
                                'target' => '_blank;'),
                            'url' => array('/factura/index')
                        ));
                        ?>
                    </div>

                    <div class="btn-group">
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => '  Imprimir Factura con Sistema Continuo',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array(
                                'onclick' => 'doSomething1(); return false;',
                                'target' => '_blank;'),
                            'url' => array('/factura/index')
                        ));
                        ?>
                    </div>

                    <div class="btn-group">
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Generar Factura a Guia',
                            'size' => 'default',
                            'icon' => 'fa fa-cogs',
                            'buttonType' => 'submit',
                            'htmlOptions' => array('onclick' => 'return validation(1);'),
                            'url' => array('index')
                        ));
                        ?>
                    </div>

                    <div class="btn-group">
                        <?php
                        $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Generar Excel',
                            'size' => 'default',
                            'icon' => 'fa fa-file-excel-o fa-lg',
                            'buttonType' => 'link',
                            'url' => array('reporte/Factura')
                        ));
                        ?>
                    </div>

                </div>

            </div>

            <script>
                function doSomething() {

                    var item = $("form input:checkbox:checked");
                    if (item.length == 0) {
                        alert('Debe seleccionar las Facturas que requiere imprimir');
                        return false;
                    }
                    // alert('Plese select checkbox! ' + item.length);
                    idfactu = '';
                    hayUltimo = false;
                    for (i = item.length - 1; i >= 0; i--) {
                        if (item[0].value == '1') {
                            hayUltimo = true;
                        }

                        if (item[i].value != '1')
                            idfactu = idfactu + item[i].value;

                        if (i - 1 > 0 && hayUltimo) {
                            idfactu = idfactu + '_';
                        }

                        if (i - 1 >= 0 && !hayUltimo) {
                            idfactu = idfactu + '_';
                        }

                    }

                    hhref = 'factura/ajax1?type=id_factu&id=' + idfactu;
                    window.open(hhref, '_blank');
                    return false;
                }

            </script>

            <script>
                function doSomething1() {

                    var item = $("form input:checkbox:checked");
                    if (item.length == 0) {
                        alert('Debe seleccionar las Facturas que requiere imprimir');
                        return false;
                    }
                    // alert('Plese select checkbox! ' + item.length);
                    idfactu = '';
                    hayUltimo = false;
                    for (i = item.length - 1; i >= 0; i--) {

                        if (item[0].value == '1') {
                            hayUltimo = true;
                        }

                        if (item[i].value != '1')
                            idfactu = idfactu + item[i].value;

                        if (i - 1 > 0 && hayUltimo) {
                            idfactu = idfactu + '_';
                        }

                        if (i - 1 >= 0 && !hayUltimo) {
                            idfactu = idfactu + '_';
                        }

                    }


                    hhref = 'factura/ajax2?type=id_factu&id=' + idfactu;
                    window.open(hhref, '_blank');
                    return false;
                }
            </script>

            <script>
                function validation(code) {

                    var item = $("form input:checkbox:checked");
                    if (item.length === 0) {

                        if (code === 1)
                            alert('Debe seleccionar las Facturas que requieren procesar a Guía ');
                        else
                            alert('Debe seleccionar las Facturas que requieren anular ');
                        return false;
                    }

                    if (!confirm('¿Estas Seguro de generar masivamente las Facturas?, sólo se consideraran aquellas Facturas en estado creado ')) {
                        return false;
                    }

                    for (i = 0; i < item.length; i++) {

                        if (code === 2) {
                            $.ajax({
                                url: './ajax',
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
                                url: './ajax',
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

        </div>
    </div>

<?php $this->endWidget(); ?>