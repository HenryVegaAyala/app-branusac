<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */

$this->breadcrumbs=array(
	'Facfactus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FACFACTU', 'url'=>array('index')),
	array('label'=>'Manage FACFACTU', 'url'=>array('admin')),
);
?>

<h1>Create FACFACTU</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>