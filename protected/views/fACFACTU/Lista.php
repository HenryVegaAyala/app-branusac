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
            <h3 class="panel-title">Lista de Facturas Creadas</h3>
        </div>

        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>

        <div class="mar">
            <?php // echo CHtml::link('Búsqueda Avanzada', '#', array('class' => 'search-button'));  ?>
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
                'dataProvider' => $model->search(),
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

                    </div>
                </div>    
            </div>        
        </div>
    </div>
</div>    

<?php $this->endWidget(); ?>