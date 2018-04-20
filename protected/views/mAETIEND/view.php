<?php
/* @var $this MAETIENDController */
/* @var $model MAETIEND */

$this->breadcrumbs=array(
	'Maetiends'=>array('index'),
	$model->COD_TIEN,
);

$this->menu=array(
	array('label'=>'List MAETIEND', 'url'=>array('index')),
	array('label'=>'Create MAETIEND', 'url'=>array('create')),
	array('label'=>'Update MAETIEND', 'url'=>array('update', 'id'=>$model->COD_TIEN)),
	array('label'=>'Delete MAETIEND', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->COD_TIEN),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MAETIEND', 'url'=>array('admin')),
);
?>

<h1>View MAETIEND #<?php echo $model->COD_TIEN; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'COD_CLIE',
		'COD_TIEN',
		'DES_TIEN',
		'DIR_TIEN',
		'COD_ESTA',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
	),
)); ?>
