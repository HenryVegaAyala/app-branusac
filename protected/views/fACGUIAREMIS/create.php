<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */

$this->breadcrumbs=array(
	'Facguiaremises'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FACGUIAREMIS', 'url'=>array('index')),
	array('label'=>'Manage FACGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>Create FACGUIAREMIS</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>