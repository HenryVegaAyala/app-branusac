<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'post',
        ));
?>

<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs = array(
    'Lista de Presupuesto',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facordencompr-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Búsqueda Presupuesto</h3>
        </div>

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
        </div><!-- search-form -->

        <div class="table-responsive">
            <?php
            $this->widget('ext.bootstrap.widgets.TbGridView', array(
                'id' => 'facordencompr-grid',
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
                        'value' => '$data->cODTIEN->DES_TIEN'
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
                        'value' => function($data) {

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
                        'value' => function($data) {
                            $model = new FACORDENCOMPR();
                            $variable = $data->__GET('COD_ORDE');
                            echo $model->getGuia($variable);
                        }
                    ),
                    array(
                        'name' => 'COD_TIEN',
                        'header' => 'N° de Factura',
                        'value' => function($data) {
                            $model = new FACORDENCOMPR();
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
                                'label' => 'Actualizar O/C',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACORDENCOMPR/update", array("id"=>$data->COD_ORDE,"est"=>$data->IND_ESTA))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 1 || id == 2 || id == 9){
                                        alert ('Este N° de O/C no puede ser actualizado debe estar en estado creado');
                                        return false
                                    }
                                     if (confirm ('¿ Estas Seguro de actualizar la O/C ?')){
                                            return true;
                                        }
                                            return false;
                                    
                               
                                }",
                            ),
                            'Anular' => array(
                                'icon' => 'trash',
                                'label' => 'Anular O/C',
//                                'visible' => 'false',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'url' => 'Yii::app()->controller->createUrl("/FACORDENCOMPR/Anular", array("id"=>$data->COD_ORDE,"est"=>$data->IND_ESTA))',
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
                                        alert ('Este N° de O/C ya fue Anulado');
                                        return false;
                                    }else{
                                     if (confirm ('¿ Estas Seguro de Anular la O/C ?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                            ),
                            'Guia' => array(
                                'icon' => 'book',
                                'label' => 'Generar Guia',
                                'htmlOptions' => array('style' => 'width: 50px'),
//                                'visible' => 'array("$data->IND_ESTA") < 1',
                                'url' => 'Yii::app()->controller->createUrl("/FACGUIAREMIS/Lista", array("id"=>$data->COD_ORDE,"est"=>$data->IND_ESTA,"no"=>$data->NUM_ORDE))',
                                'click' => "function (){
                                    var x = this.href;
                                    var cad = x.split('/');
                                    var pos = cad[cad.length-1].indexOf('?');
                                    var id = cad[cad.length-1].substring(pos+5);
                                        
                                    if(id == 2 ||  id == 9){
                                        alert ('No puede generarse la Guia,la O/C debe estar en estado creado');
                                        return false
                                    }
                                    if(id == 1 ){
                                        alert ('En este N° de O/C ya fue generado la Guia, por favor revisar');
                                        return false;
                                    }else{
                                     if (confirm ('¿ Estas Seguro de generar Guia para esta O/C ?')){
                                            return true;
                                        }
                                            return false;
                                    }
                               
                                }",
                            ),
                            'Reporte' => array(
                                'icon' => 'file',
                                'label' => 'Generar PDF',
                                'htmlOptions' => array('style' => 'width: 50px'),
                                'options' => array('target' => '_blank'),
                                'url' => 'CHtml::normalizeUrl(array("Reporte", "id"=>$data->COD_ORDE))',
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
                        'label' => 'Refrescar Lista O/C',
                        'size' => 'default',
                        'icon' => 'refresh',
                        'buttonType' => 'link',
                        'url' => array('/FACORDENCOMPR/index')
                    ));
                    ?>

                    <?php
                    echo
                    CHtml::SubmitButton('Generacion Guia Masiva ', array(
                        'onclick' => 'return validation(1);',
                        'class' => 'btn btn-default btn-md'));
                    ?>
                    <?php
                    echo
                    CHtml::SubmitButton('Anulación Masiva', array(
                        'onclick' => 'return validation(2);',
                        'class' => 'btn btn-default btn-md'));
                    ?>

                    <script>
                        function validation(code) {

                            var item = $("form input:checkbox:checked");
                            if (item.length == 0) {
                                if (code == 1)
                                    alert('Debe seleccionar las O/C que requiere procesar ');
                                else
                                    alert('Debe seleccionar las O/C que requiere anular ');
                                return false;
                            }
                            if (!confirm('Estas Seguro de generar masivamente las Guia?, sólo se consideraran aquellas O/C en estado creado ')) {
                                return false;
                            }

                            for (i = 0; i < item.length; i++) {

                                if (code === 2) {
                                    $.ajax({
                                        url: 'FACORDENCOMPR/ajax',
                                        dataType: "json",
                                        async: false,
                                        data: {
                                            type: 'id_sele',
                                            id: item[i].value
                                        },
                                        succes: function(data) {

                                            response($.map(data, function(item) {

                                                // alert(item);
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
                                        url: 'FACORDENCOMPR/ajax',
                                        dataType: "json",
                                        async: false,
                                        data: {
                                            type: 'id_oc_tg',
                                            id: item[i].value
                                        },
                                        succes: function(data) {

                                            response($.map(data, function(item) {

                                                // alert(item);
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

<?php $this->endWidget(); ?>