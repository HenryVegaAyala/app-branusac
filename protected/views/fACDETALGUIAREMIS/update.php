<?php
/* @var $this FACDETALGUIAREMISController */
/* @var $model FACDETALGUIAREMIS */

$this->breadcrumbs=array(
	'Facdetalguiaremises'=>array('index'),
	$model->GUIA_DET=>array('view','id'=>$model->GUIA_DET),
	'Update',
);

$this->menu=array(
	array('label'=>'List FACDETALGUIAREMIS', 'url'=>array('index')),
	array('label'=>'Create FACDETALGUIAREMIS', 'url'=>array('create')),
	array('label'=>'View FACDETALGUIAREMIS', 'url'=>array('view', 'id'=>$model->GUIA_DET)),
	array('label'=>'Manage FACDETALGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>Update FACDETALGUIAREMIS <?php echo $model->GUIA_DET; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>