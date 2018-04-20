<?php
/* @var $this MAECLIENController */
/* @var $model MAECLIEN */

$this->breadcrumbs=array(
	'Maecliens'=>array('index'),
	$model->COD_CLIE=>array('view','id'=>$model->COD_CLIE),
	'Update',
);

$this->menu=array(
	array('label'=>'List MAECLIEN', 'url'=>array('index')),
	array('label'=>'Create MAECLIEN', 'url'=>array('create')),
	array('label'=>'View MAECLIEN', 'url'=>array('view', 'id'=>$model->COD_CLIE)),
	array('label'=>'Manage MAECLIEN', 'url'=>array('admin')),
);
?>

<h1>Update MAECLIEN <?php echo $model->COD_CLIE; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>