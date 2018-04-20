<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'post',
        ));
?>

<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */

$this->breadcrumbs = array(
    'Lista Guia',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facguiaremis-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda Guias</h3>
        </div>
        <?php if (Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
        <?php endif ?>
        <div class="mar">
            <div class="mar">            
                <?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
                <br>
                <?php
                $this->widget('ext.PageSize.EPageSize', array(
                    'gridViewId' => 'facguiaremis-grid',
                    'beforeLabel' => 'Seleccionar Cantidad de Guias',
                    'pageSize' => Yii::app()->request->getParam('pageSize', null),
                    'defaultPageSize' => 10, // may use this :  Yii::app()->params['defaultPageSize'],
                    'pageSizeOptions' => array(5 => 5, 10 => 10, 25 => 25, 50 => 50, 100 => 100, 500 => 500), // you can config it in main.php under the config dir . Yii::app()->params['pageSizeOptions'],// Optional, you can use with the widget default
                ));

                $dataProvider = $model->search();
                $pageSize = Yii::app()->user->getState('pageSize', 10/* Yii::app()->params['defaultPageSize'] */);
                $dataProvider->getPagination()->setPageSize($pageSize);
                ?>
            </div>
        </div>

        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div><!-- search-form -->

        <div class="table-responsive">
            <?php
            $this->widget('ext.bootstrap.widgets.TbGridView', array(
                'id' => 'facguiaremis-grid',
                'type' => 'bordered condensed striped',
                'dataProvider' => $dataProvider,
                'columns' => array(
                    array(
                        'id' => 'COD_GUIA',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    'COD_GUIA',
                    array(
                        'name' => 'COD_ORDE',
                        'header' => 'N° de Orden',
                        'value' => '$data->cODORDE->NUM_ORDE'
                    ),
                    array(
                        'name' => 'COD_TIEN',
                        'header' => 'Tienda',
                        'value' => function($data) {
                            $tienda = $data->__GET('COD_TIEN');
                            $max = Yii::app()->db->createCommand()
                                    ->select('DES_TIEN')
                                    ->from('mae_tiend')
                                    ->where("COD_TIEN = '" . $tienda . "';")
                                    ->queryScalar();

                            $id = ($max);
                            return $id;
                        }
                    ),
                    array(
                        'name' => 'FEC_EMIS',
                        'header' => 'Fecha de Envio',
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_EMIS))'
                    ),
                    array(
                        'name' => 'IND_ESTA',
                        'header' => 'Estado',
                        'value' => function($data) {

                            $variable = $data->__GET('IND_ESTA');
                            switch ($variable) {
                                case 1:
                                    echo 'Emitida / Pendiente de cobro';
                                    break;
                                case 2:
                                    echo 'Cobrada / Cerrada';
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
                        'name' => 'IND_ESTA',
                        'header' => 'N° de Factura',
                        'value' => function($data) {
                            $model = new FACGUIAREMIS();
                            $variable = $data->__GET('COD_GUIA');
                            echo $model->getFactura($variable);
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
                                'url' => 'Yii::app()->controller->createUrl("/FACGUIAREMIS/update", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
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
                                'url' => 'Yii::app()->controller->createUrl("/FACGUIAREMIS/Anular", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2){
                                        alert ('Este N° de Guia no puede ser anulado debe estar en estado creado');
                                        return false
                                    }
                                    if(id == 9 ){
                                        alert ('Este N° de Guia ya fue Anulado');
                                        return false;
                                    }else{
                                     if (confirm ('¿ Estas Seguro de Anular la Guia ?')){
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
                                'url' => 'Yii::app()->controller->createUrl("/FACGUIAREMIS/Reporte", array("id"=>$data->COD_GUIA))',
                            ),
                            'Factura' => array(
                                'icon' => 'book',
                                'label' => 'Generar Factura',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACFACTU/Lista", array("id"=>$data->COD_GUIA,"est"=>$data->IND_ESTA))',
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
                                        alert ('En este N° de Guia ya fue generado la Factura, por favor revisar');
                                        return false;
                                    }else{
                                     if (confirm ('¿ Estas Seguro de generar la Factura para esta Guia ?')){
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
                            'url' => array('/FACGUIAREMIS/index')
                        ));
                        ?>
                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => ' Imprimir Guias Masivas',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array('onclick' => 'doSomething(); return false;', 'target' => '_blank;'),
                            'url' => array('/FACGUIAREMIS/index')
                        ));
                        ?>
                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => ' Imprimir Guias Masivas Continuo',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array('onclick' => 'doSomething1(); return false;', 'target' => '_blank;'),
                            'url' => array('/FACGUIAREMIS/index')
                        ));
                        ?>
                        <?php
//                        echo CHtml::link('<i class="fa fa-print fa-lg" aria-hidden="true" ></i> Imprimir Guias Masivas', "javascript:;", array(
//                            'style' => 'background-image: none;
//                                        border: 1px solid transparent;
//                                        border-radius: 4px;
//                                        cursor: pointer;
//                                        display: inline-block;
//                                        font-size: 14px;
//                                        font-weight: normal;
//                                        line-height: 1.42857;
//                                        margin-bottom: 1;
//                                        padding: 6px 12px;
//                                        text-align: center;
//                                        vertical-align: middle;
//                                        white-space: nowrap;
//                                        background-color: #FFFFFF;
//                                        color: #222222;
//                                        text-decoration: none;',
//                            'target' => '_blank;',
//                            "onclick" => "doSomething(); return false;"
//                        ));
                        ?>
                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Procesar Guias',
                            'size' => 'default',
                            'icon' => 'fa fa-hourglass-end',
                            'buttonType' => 'submit',
                            'htmlOptions' => array('onclick' => 'return validation(1);'),
                            'url' => array('/FACGUIAREMIS/index')
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
                            'url' => array('/FACGUIAREMIS/index')
                        ));
                        ?>
                        <?php
//                        echo CHtml::SubmitButton('Procesar Guias', array(
//                            'onclick' => 'return validation(1);',
//                            'class' => 'btn btn-default btn-md'));
                        ?>
                        <?php
//                        echo CHtml::SubmitButton('Anulación Masiva', array(
//                            'onclick' => 'return validation(2);',
//                            'class' => 'btn btn-default btn-md'));
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
                                // alert('Plese select checkbox! ' + item.length);

                                if (!confirm('Estas Seguro de generar masivamente las Guías?, sólo se consideraran aquellas Guías en estado creado ')) {
                                    return false;
                                }

                                for (i = 0; i < item.length; i++) {

                                    if (code === 2) {
                                        $.ajax({
                                            url: 'FACGUIAREMIS/ajax',
                                            dataType: "json",
                                            async: false,
                                            data: {
                                                type: 'id_sele',
                                                id: item[i].value
                                            },
                                            succes: function(data) {

                                                response($.map(data, function(item) {


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
                                            url: 'FACGUIAREMIS/ajax',
                                            dataType: "json",
                                            async: false,
                                            data: {
                                                type: 'id_guia_factu',
                                                id: item[i].value
                                            },
                                            succes: function(data) {

                                                response($.map(data, function(item) {

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
                                    alert('Debe seleccionar las Guías    que requiere imprimir');
                                    return false;
                                }
//                                 alert('Plese select checkbox! ' + item.length);
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

                                hhref = 'FACGUIAREMIS/ajax?type=id_guia&id=' + idguia;
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
//                                 alert('Plese select checkbox! ' + item.length);
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

                                hhref = 'FACGUIAREMIS/ajax2?type=id_guia&id=' + idguia;
                                window.open(hhref, '_blank');
                                return false;
                            }
                        </script>
                    </div>
                </div>    
            </div>        
        </div>
    </div>
</div>    
<?php $this->endWidget(); ?>