<?php
/* @var $this MAETIENDController */
/* @var $model MAETIEND */

$this->breadcrumbs=array(
	'Maetiends'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MAETIEND', 'url'=>array('index')),
	array('label'=>'Manage MAETIEND', 'url'=>array('admin')),
);
?>

<h1>Create MAETIEND</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>