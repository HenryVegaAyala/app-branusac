<?php
/* @var $this FolioController */
/* @var $model Folio */

$this->breadcrumbs = array(
	'Numeración'=>array('index'),
	'Actualización',
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>