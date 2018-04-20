<?php
/* @var $this FACDETALFACTUController */
/* @var $model FACDETALFACTU */

$this->breadcrumbs=array(
	'Facdetalfactus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FACDETALFACTU', 'url'=>array('index')),
	array('label'=>'Manage FACDETALFACTU', 'url'=>array('admin')),
);
?>

<h1>Create FACDETALFACTU</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>