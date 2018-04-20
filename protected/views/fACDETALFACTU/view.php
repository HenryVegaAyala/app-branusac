<?php
/* @var $this FACDETALFACTUController */
/* @var $model FACDETALFACTU */

$this->breadcrumbs=array(
	'Facdetalfactus'=>array('index'),
	$model->FACT_DET,
);

$this->menu=array(
	array('label'=>'List FACDETALFACTU', 'url'=>array('index')),
	array('label'=>'Create FACDETALFACTU', 'url'=>array('create')),
	array('label'=>'Update FACDETALFACTU', 'url'=>array('update', 'id'=>$model->FACT_DET)),
	array('label'=>'Delete FACDETALFACTU', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->FACT_DET),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FACDETALFACTU', 'url'=>array('admin')),
);
?>

<h1>View FACDETALFACTU #<?php echo $model->FACT_DET; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_FACT',
		'COD_PROD',
		'UNI_SOLI',
		'VAL_PROD',
		'IMP_PROD',
		'IGV_PROD',
		'IMP_TOTA_PROD',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
		'FACT_DET',
	),
)); ?>
