<?php
/* @var $this FACDETALORDENCOMPRController */
/* @var $model FACDETALORDENCOMPR */

$this->breadcrumbs=array(
	'Facdetalordencomprs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FACDETALORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Manage FACDETALORDENCOMPR', 'url'=>array('admin')),
);
?>

<h1>Create FACDETALORDENCOMPR</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>