<?php
/* @var $this MAECLIENController */
/* @var $model MAECLIEN */

$this->breadcrumbs=array(
	'Maecliens'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MAECLIEN', 'url'=>array('index')),
	array('label'=>'Create MAECLIEN', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#maeclien-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Maecliens</h1>

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
	'id'=>'maeclien-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'COD_CLIE',
		'DES_CLIE',
		'DIR_FISC',
		'NRO_RUC',
		'COD_DEPT',
		'COD_PROV',
		/*
		'COD_DIST',
		'NRO_TEL1',
		'NRO_TEL2',
		'NRO_TEL3',
		'DIR_WEB',
		'DIR_EMA1',
		'DIR_EMA2',
		'DIR_EMA3',
		'COD_ESTA',
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
