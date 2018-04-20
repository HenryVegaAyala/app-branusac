<?php
/* @var $this MAECLIENController */
/* @var $model MAECLIEN */

$this->breadcrumbs=array(
	'Maecliens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MAECLIEN', 'url'=>array('index')),
	array('label'=>'Manage MAECLIEN', 'url'=>array('admin')),
);
?>

<h1>Create MAECLIEN</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>