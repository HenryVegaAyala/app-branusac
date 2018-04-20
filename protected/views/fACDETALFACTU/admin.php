<?php
/* @var $this FACDETALFACTUController */
/* @var $model FACDETALFACTU */

$this->breadcrumbs=array(
	'Facdetalfactus'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FACDETALFACTU', 'url'=>array('index')),
	array('label'=>'Create FACDETALFACTU', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facdetalfactu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Facdetalfactus</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'facdetalfactu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'COD_FACT',
		'COD_PROD',
		'UNI_SOLI',
		'VAL_PROD',
		'IMP_PROD',
		'IGV_PROD',
		/*
		'IMP_TOTA_PROD',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
		'FACT_DET',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
