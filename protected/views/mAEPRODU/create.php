<?php
/* @var $this MAEPRODUController */
/* @var $model MAEPRODU */

$this->breadcrumbs=array(
	'Maeprodus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MAEPRODU', 'url'=>array('index')),
	array('label'=>'Manage MAEPRODU', 'url'=>array('admin')),
);
?>

<h1>Create MAEPRODU</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>