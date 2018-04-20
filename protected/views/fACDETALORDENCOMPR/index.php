<?php

/* @var $this FACDETALORDENCOMPRController */
/* @var $model FACDETALORDENCOMPR */

$this->breadcrumbs = array(
    'Facdetalordencomprs' => array('index'),
    'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facdetalordencompr-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'facdetalordencompr-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'COD_CLIE',
        'COD_TIEN',
        'COD_ORDE',
        'COD_PROD',
        'NRO_UNID',
        'VAL_PREC',
        /*
          'VAL_IGV',
          'VAL_MONT_UNID',
          'VAL_MONT_IGV',
          'USU_DIGI',
          'FEC_DIGI',
          'USU_MODI',
          'FEC_MODI',
         */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
