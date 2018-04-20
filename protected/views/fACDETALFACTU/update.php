<?php
/* @var $this FACDETALFACTUController */
/* @var $model FACDETALFACTU */

$this->breadcrumbs=array(
	'Facdetalfactus'=>array('index'),
	$model->FACT_DET=>array('view','id'=>$model->FACT_DET),
	'Update',
);

$this->menu=array(
	array('label'=>'List FACDETALFACTU', 'url'=>array('index')),
	array('label'=>'Create FACDETALFACTU', 'url'=>array('create')),
	array('label'=>'View FACDETALFACTU', 'url'=>array('view', 'id'=>$model->FACT_DET)),
	array('label'=>'Manage FACDETALFACTU', 'url'=>array('admin')),
);
?>

<h1>Update FACDETALFACTU <?php echo $model->FACT_DET; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>