<?php
/* @var $this MAECLIENController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Maecliens',
);

$this->menu=array(
	array('label'=>'Create MAECLIEN', 'url'=>array('create')),
	array('label'=>'Manage MAECLIEN', 'url'=>array('admin')),
);
?>

<h1>Maecliens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
