<?php
/* @var $this FACDETALGUIAREMISController */
/* @var $model FACDETALGUIAREMIS */

$this->breadcrumbs=array(
	'Facdetalguiaremises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FACDETALGUIAREMIS', 'url'=>array('index')),
	array('label'=>'Manage FACDETALGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>Create FACDETALGUIAREMIS</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>