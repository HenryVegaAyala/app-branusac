<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */

$this->breadcrumbs=array(
	'Facfactus'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FACFACTU', 'url'=>array('index')),
	array('label'=>'Create FACFACTU', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facfactu-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Facfactus</h1>

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
	'id'=>'facfactu-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'COD_FACT',
		'COD_CLIE',
		'COD_GUIA',
		'FEC_FACT',
		'FEC_PAGO',
		'IND_ESTA',
		/*
		'VAL_IGV',
		'TOT_UNID_FACT',
		'TOT_FACT_SIN_IGV',
		'TOT_IGV',
		'TOT_FACT',
		'USU_DIGI',
		'FEC_DIGI',
		'USU_MODI',
		'FEC_MODI',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
