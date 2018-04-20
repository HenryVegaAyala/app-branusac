<?php
/* @var $this FACDETALFACTUController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Facdetalfactus',
);

$this->menu=array(
	array('label'=>'Create FACDETALFACTU', 'url'=>array('create')),
	array('label'=>'Manage FACDETALFACTU', 'url'=>array('admin')),
);
?>

<h1>Facdetalfactus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
