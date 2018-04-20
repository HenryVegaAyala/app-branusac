<?php
/* @var $this FACDETALORDENCOMPRController */
/* @var $model FACDETALORDENCOMPR */

$this->breadcrumbs=array(
	'Facdetalordencomprs'=>array('index'),
	$model->COD_ORDE=>array('view','id'=>$model->COD_ORDE),
	'Update',
);

$this->menu=array(
	array('label'=>'List FACDETALORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create FACDETALORDENCOMPR', 'url'=>array('create')),
	array('label'=>'View FACDETALORDENCOMPR', 'url'=>array('view', 'id'=>$model->COD_ORDE)),
	array('label'=>'Manage FACDETALORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>Update FACDETALORDENCOMPR <?php echo $model->COD_ORDE; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>