<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs = array(
    'Presupuesto' => array('index'),
    'Nuevo',
);
?>

<h1>Nuevo Presupuesto</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>