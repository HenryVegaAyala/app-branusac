<?php
/* @var $this MAEPRODUController */
/* @var $model MAEPRODU */

$this->breadcrumbs=array(
	'Maeprodus'=>array('index'),
	$model->COD_PROD=>array('view','id'=>$model->COD_PROD),
	'Update',
);

$this->menu=array(
	array('label'=>'List MAEPRODU', 'url'=>array('index')),
	array('label'=>'Create MAEPRODU', 'url'=>array('create')),
	array('label'=>'View MAEPRODU', 'url'=>array('view', 'id'=>$model->COD_PROD)),
	array('label'=>'Manage MAEPRODU', 'url'=>array('admin')),
);
?>

<h1>Update MAEPRODU <?php echo $model->COD_PROD; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>