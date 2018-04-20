<?php
/* @var $this FACDETALGUIAREMISController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Facdetalguiaremises',
);

$this->menu=array(
	array('label'=>'Create FACDETALGUIAREMIS', 'url'=>array('create')),
	array('label'=>'Manage FACDETALGUIAREMIS', 'url'=>array('admin')),
);
?>

<h1>Facdetalguiaremises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
