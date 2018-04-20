<?php
/* @var $this MAEPRODUController */
/* @var $model MAEPRODU */

$this->breadcrumbs=array(
	'Maeprodus'=>array('index'),
	$model->COD_PROD,
);

$this->menu=array(
	array('label'=>'List MAEPRODU', 'url'=>array('index')),
	array('label'=>'Create MAEPRODU', 'url'=>array('create')),
	array('label'=>'Update MAEPRODU', 'url'=>array('update', 'id'=>$model->COD_PROD)),
	array('label'=>'Delete MAEPRODU', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_PROD),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MAEPRODU', 'url'=>array('admin')),
);
?>

<h1>View MAEPRODU #<?php echo $model->COD_PROD; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_PROD',
		'COD_LINE',
		'DES_LARG',
		'DES_CORT',
		'COD_ESTA',
		'COD_MEDI',
		'VAL_PESO',
		'VAL_PROD',
		'VAL_CONV',
		'VAL_PORC',
		'VAL_COST',
		'VAL_REPO',
		'COD_LOTE',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
	),
)); ?>
