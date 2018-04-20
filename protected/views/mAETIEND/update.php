<?php
/* @var $this MAETIENDController */
/* @var $model MAETIEND */

$this->breadcrumbs=array(
	'Maetiends'=>array('index'),
	$model->COD_TIEN=>array('view','id'=>$model->COD_TIEN),
	'Update',
);

$this->menu=array(
	array('label'=>'List MAETIEND', 'url'=>array('index')),
	array('label'=>'Create MAETIEND', 'url'=>array('create')),
	array('label'=>'View MAETIEND', 'url'=>array('view', 'id'=>$model->COD_TIEN)),
	array('label'=>'Manage MAETIEND', 'url'=>array('admin')),
);
?>

<h1>Update MAETIEND <?php echo $model->COD_TIEN; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>