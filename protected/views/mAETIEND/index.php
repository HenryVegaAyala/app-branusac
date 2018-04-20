<?php
/* @var $this MAETIENDController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Maetiends',
);

$this->menu=array(
	array('label'=>'Create MAETIEND', 'url'=>array('create')),
	array('label'=>'Manage MAETIEND', 'url'=>array('admin')),
);
?>

<h1>Maetiends</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
