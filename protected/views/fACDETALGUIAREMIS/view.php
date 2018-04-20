<?php
/* @var $this FACDETALGUIAREMISController */
/* @var $model FACDETALGUIAREMIS */

$this->breadcrumbs=array(
	'Facdetalguiaremises'=>array('index'),
	$model->GUIA_DET,
);

$this->menu=array(
	array('label'=>'List FACDETALGUIAREMIS', 'url'=>array('index')),
	array('label'=>'Create FACDETALGUIAREMIS', 'url'=>array('create')),
	array('label'=>'Update FACDETALGUIAREMIS', 'url'=>array('update', 'id'=>$model->GUIA_DET)),
	array('label'=>'Delete FACDETALGUIAREMIS', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->GUIA_DET),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FACDETALGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>View FACDETALGUIAREMIS #<?php echo $model->GUIA_DET; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_GUIA',
		'COD_PROD',
		'PES_PROD',
		'UNI_SOLI',
		'VAL_PROD',
		'IMP_PROD',
		'IGV_PROD',
		'IMP_TOTA_PROD',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
		'GUIA_DET',
	),
)); ?>
