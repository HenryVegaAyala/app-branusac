<?php
/* @var $this MAECLIENController */
/* @var $model MAECLIEN */

$this->breadcrumbs=array(
	'Maecliens'=>array('index'),
	$model->COD_CLIE,
);

$this->menu=array(
	array('label'=>'List MAECLIEN', 'url'=>array('index')),
	array('label'=>'Create MAECLIEN', 'url'=>array('create')),
	array('label'=>'Update MAECLIEN', 'url'=>array('update', 'id'=>$model->COD_CLIE)),
	array('label'=>'Delete MAECLIEN', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_CLIE),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MAECLIEN', 'url'=>array('admin')),
);
?>

<h1>View MAECLIEN #<?php echo $model->COD_CLIE; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_CLIE',
		'DES_CLIE',
		'DIR_FISC',
		'NRO_RUC',
		'COD_DEPT',
		'COD_PROV',
		'COD_DIST',
		'NRO_TEL1',
		'NRO_TEL2',
		'NRO_TEL3',
		'DIR_WEB',
		'DIR_EMA1',
		'DIR_EMA2',
		'DIR_EMA3',
		'COD_ESTA',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
	),
)); ?>
