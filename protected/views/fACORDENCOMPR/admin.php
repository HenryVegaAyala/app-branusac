<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */

$this->breadcrumbs=array(
	'Facordencomprs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FACORDENCOMPR', 'url'=>array('index')),
	array('label'=>'Create FACORDENCOMPR', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#facordencompr-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Facordencomprs</h1>

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
	'id'=>'facordencompr-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'COD_CLIE',
		'COD_TIEN',
		'COD_ORDE',
		'NUM_ORDE',
		'IND_TIPO',
		'TIP_MONE',
		/*
		'TOT_UNID_SOLI',
		'TOT_MONT_ORDE',
		'TOT_MONT_IGV',
		'TOT_FACT',
		'FEC_PAGO',
		'IND_ESTA',
		'FEC_INGR',
		'FEC_ENVI',
		'FEC_ANUL',
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
