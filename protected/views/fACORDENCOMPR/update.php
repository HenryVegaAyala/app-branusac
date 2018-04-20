<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs=array(
	'O/C'=>array('index'),
	'Actualizar O/C',
);
?>

<h1>Actualizar Presupuesto <?php $model->COD_ORDE; ?></h1>

<?php $this->renderPartial('_update', array('model'=>$model)); ?>