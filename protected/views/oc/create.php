<?php
/* @var $this OCController */
/* @var $model OC */

$this->pageTitle = 'Nuevo Presupuesto';
$this->breadcrumbs = array(
    'Presupuesto' => array('index'),
    'Nuevo',
);
?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>