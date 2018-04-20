<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'post',
        ));
?>

<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */

$this->breadcrumbs = array(
    'Factura' => array('index'),
    'Buscar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facfactu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda Factura</h3>
        </div>

        <div class="mar">
            <div class="mar">            
                <?php echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
                <br>
                <?php
                $this->widget('ext.PageSize.EPageSize', array(
                    'gridViewId' => 'facfactu-grid',
                    'beforeLabel' => 'Seleccionar Cantidad de Facturas',
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
                'id' => 'facfactu-grid',
                'type' => 'bordered condensed striped',
                'dataProvider' => $dataProvider,
                'columns' => array(
                    array(
                        'id' => 'COD_FACT',
                        'class' => 'CCheckBoxColumn',
                        'selectableRows' => '50',
                    ),
                    'COD_FACT',
                    array(
                        'name' => 'COD_CLIE',
                        'header' => 'Cliente',
                        'value' => '$data->cODCLIE->DES_CLIE'
                    ),
                    array(
                        'name' => 'FEC_FACT',
                        'header' => 'Fecha Facturado',
                        'value' => 'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($data->FEC_FACT))'
                    ),
                    array(
                        'name' => 'FEC_PAGO',
                        'header' => 'Fecha de Pago',
                        'value' => function($data) {

                            $variable = $data->__GET('FEC_PAGO');
                            if ($variable == null) {
                                echo 'Fecha Indefinida';
                            } else {
                                echo Yii::app()->dateFormatter->format("dd/MM/y", strtotime($data->FEC_PAGO));
                            }
                        },
                    ),
                    array(
                        'name' => 'IND_ESTA',
                        'header' => 'Estado',
                        'value' => function($data) {

                            $variable = $data->__GET('IND_ESTA');
                            switch ($variable) {
                                case 1:
                                    echo 'Emitida/Pendiente de Cobro';
                                    break;
                                case 2:
                                    echo 'Cobrada/Cerrada';
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
                    'COD_GUIA',
                    array(
                        'name' => 'COD_GUIA',
                        'header' => 'N° de O/C',
                        'value' => function($data) {
                            $model = new FACFACTU();
                            $variable = $data->__GET('COD_FACT');
                            echo $model->getOC($variable);
                        }
                    ),
                    'TOT_FACT',
                    array(
                        'header' => 'Opciones',
                        'class' => 'ext.bootstrap.widgets.TbButtonColumn',
                        'htmlOptions' => array('style' => 'width: 130px; text-align: center;'),
                        'template' => '{view} / {update} / {Anular} / {Reporte}',
                        'buttons' => array(
                            'update' => array(
                                'icon' => 'pencil',
                                'label' => 'Actualizar Factura',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACFACTU/update", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
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
                                'url' => 'Yii::app()->controller->createUrl("/FACFACTU/Anular", array("id"=>$data->COD_FACT,"est"=>$data->IND_ESTA))',
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
                                'url' => 'Yii::app()->controller->createUrl("/FACFACTU/Reporte", array("id"=>$data->COD_FACT))',
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
                            'label' => 'Refrescar Lista Facturas',
                            'size' => 'default',
                            'icon' => 'refresh',
                            'buttonType' => 'link',
                            'url' => array('/FACFACTU/index')
                        ));
                        ?>

                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Imprimir Facturas Masivas',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array(
                                'onclick' => 'doSomething(); return false;',
                                'target' => '_blank;'),
                            'url' => array('/FACFACTU/index')
                        ));
                        ?>

                        <?php
//                        echo CHtml::link('<i class="fa fa-print fa-lg" aria-hidden="true" ></i> Imprimir Facturas Masivas', "javascript:;", array(
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
//                            'onclick' => 'doSomething(); return false;',)
////                            ),
////                            array(
////                                'class' => 'btn btn-danger',
////                            )
//                        );
                        ?>

                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Imprimir Facturas Masivas Continua',
                            'size' => 'default',
                            'icon' => 'fa fa-print fa-lg',
                            'buttonType' => 'link',
                            'htmlOptions' => array(
                                'onclick' => 'doSomething1(); return false;',
                                'target' => '_blank;'),
                            'url' => array('/FACFACTU/index')
                        ));
                        ?>

                        <?php
//                        echo CHtml::link('<i class="fa fa-print fa-lg" aria-hidden="true" ></i> Imprimir Facturas Masivas Continua', "javascript:;", array(
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
//                            'onclick' => 'doSomething1(); return false;',)
//                            ),
//                            array(
//                                'class' => 'btn btn-danger',
//                            )
//                        );
                        ?>

                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Generar Excel de Factura',
                            'size' => 'default',
                            'icon' => 'fa fa-file-excel-o fa-lg',
                            'buttonType' => 'link',
                            'url' => array('REPORTE/Factura')
                        ));
                        ?>

                        <script>
                            function doSomething() {

                                var item = $("form input:checkbox:checked");
                                if (item.length == 0) {
                                    alert('Debe seleccionar las Facturas que requiere imprimir');
                                    return false;
                                }
                                // alert('Plese select checkbox! ' + item.length);
                                idfactu = '';
                                hayUltimo=false;
                                for (i = item.length-1; i >= 0; i--) {
//                                    if ((i + 1) == item.length) {//si es el ultimo elemento
//                                        idfactu = idfactu + item[i].value;
//                                    } else {
                                        if (item[0].value == '1') {
                                          hayUltimo=true;
                                        }
                                        
                                        if(item[i].value != '1')
                                            idfactu = idfactu + item[i].value;
                                        
                                        if (i-1 > 0 && hayUltimo) {
                                          idfactu=  idfactu   + '_';
                                        }
                                        
                                        if (i-1 >= 0 && !hayUltimo) {
                                          idfactu=  idfactu   + '_';
                                        }
                                  
                                }

                                hhref = 'FACFACTU/ajax?type=id_factu&id=' + idfactu;
                                window.open(hhref, '_blank');

//                                    $.ajax({
//                                        url: 'ajax.php',
//                                        dataType: "json",
//                                        
//                                        data: {
//                                            type: 'id_factu',
//                                            id: idfactu  //item[i].value
//                                        },
//                                        succes: function (data) {
//
//                                            response($.map(data, function (item) {
//
//                                                alert(item);
//                                                return {
//                                                    label: item,
//                                                    value: item,
//                                                    data: item
//                                                }
//                                            }));
//
//
//                                        }
//                                    });


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
                                  hayUltimo=false;
                                for (i = item.length-1; i >= 0; i--) {
//                                    if ((i + 1) == item.length) {//si es el ultimo elemento
//                                        idfactu = idfactu + item[i].value;
//                                    } else {
                                        if (item[0].value == '1') {
                                          hayUltimo=true;
                                        }
                                        
                                        if(item[i].value != '1')
                                            idfactu = idfactu + item[i].value;
                                        
                                        if (i-1 > 0 && hayUltimo) {
                                            idfactu=  idfactu   + '_';
                                        }
                                        
                                        if (i-1 >= 0 && !hayUltimo) {
                                          idfactu=  idfactu   + '_';
                                        }
                                  
                                }

                             
                                hhref = 'FACFACTU/ajax2?type=id_factu&id=' + idfactu;
                                window.open(hhref, '_blank');

//                                    $.ajax({
//                                        url: 'ajax.php',
//                                        dataType: "json",
//                                        
//                                        data: {
//                                            type: 'id_factu',
//                                            id: idfactu  //item[i].value
//                                        },
//                                        succes: function (data) {
//
//                                            response($.map(data, function (item) {
//
//                                                alert(item);
//                                                return {
//                                                    label: item,
//                                                    value: item,
//                                                    data: item
//                                                }
//                                            }));
//
//
//                                        }
//                                    });


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