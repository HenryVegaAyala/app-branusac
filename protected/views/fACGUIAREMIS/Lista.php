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
            <h3 class="panel-title">Lista de Guias Creadas</h3>
        </div>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php endif ?>
        <div class="mar">
            <?php // echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button')); ?>
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
                'dataProvider' => $model->search(),
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
                        'name' => 'Factura',
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
                                'icon' => 'file',
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php
                        $this->widget(
                                'ext.bootstrap.widgets.TbButton', array(
                            'context' => 'default',
                            'label' => 'Mostrar Lista Guias',
                            'size' => 'default',
                            'icon' => 'refresh',
                            'buttonType' => 'link',
                            'url' => array('/FACGUIAREMIS/index')
                        ));
                        ?>
                        <?php echo CHtml::SubmitButton('Generacion Factura Masiva', array('onclick' => 'return validation(1);', 'class' => 'btn btn-default btn-md')); ?>
                        <?php echo CHtml::SubmitButton('Anulación Masiva', array('onclick' => 'return validation(2);', 'class' => 'btn btn-default btn-md')); ?>
                        <script>
                            function validation(code) {

                                var item = $("form input:checkbox:checked");
                                if (item.length == 0) {
                                    alert('Debe seleccionar las Guías que requieren procesar a Factura');
                                    return false;
                                }
                                // alert('Plese select checkbox! ' + item.length);

                                for (i = 0; i < item.length; i++) {

                                    if (code == 2) {
                                    $.ajax({
                                        url: 'FACGUIAREMIS/ajax',
                                        dataType: "json",
                                        data: {
                                            type: 'id_sele',
                                            id: item[i].value
                                        },
                                        succes: function(data) {

                                            response($.map(data, function(item) {

                                                alert(item);
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
                                            data: {
                                                type: 'id_guia_factu',
                                                id: item[i].value
                                            },
                                            succes: function(data) {

                                                response($.map(data, function(item) {

                                                    alert(item);
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
    </div>
</div>    

<?php $this->endWidget(); ?>