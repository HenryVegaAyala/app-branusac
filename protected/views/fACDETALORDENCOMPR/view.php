<?php
/* @var $this FACDETALORDENCOMPRController */
/* @var $model FACDETALORDENCOMPR */

$this->breadcrumbs=array(
	'Facdetalordencomprs'=>array('index'),
	$model->COD_ORDE,
);

$this->menu=array(
	array('label'=>'List FACDETALORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create FACDETALORDENCOMPR', 'url'=>array('create')),
	array('label'=>'Update FACDETALORDENCOMPR', 'url'=>array('update', 'id'=>$model->COD_ORDE)),
	array('label'=>'Delete FACDETALORDENCOMPR', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_ORDE),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FACDETALORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>View FACDETALORDENCOMPR #<?php echo $model->COD_ORDE; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_CLIE',
		'COD_TIEN',
		'COD_ORDE',
		'COD_PROD',
		'NRO_UNID',
		'VAL_PREC',
		'VAL_IGV',
		'VAL_MONT_UNID',
		'VAL_MONT_IGV',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
	),
)); ?>
