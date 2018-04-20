<?php
/* @var $this GuiaController */
/* @var $model Guia */

$this->breadcrumbs=array(
	'Lista Guia'=>array('index'),
	'Actualizar Guia',
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>