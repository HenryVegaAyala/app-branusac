<?php
/* @var $this FACGUIAREMISController */
/* @var $model FACGUIAREMIS */
/* @var $form CActiveForm */
?>

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/stylev2.css');
?>
<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="fieldset">

        <div class="container-fluid">
           
            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <?php echo $form->label($model, 'COD_GUIA'); ?>
                    <?php echo $form->textField($model, 'COD_GUIA', array('class' => 'form-control')); ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->label($model, 'COD_ORDE'); ?>
                    <?php echo $form->textField($model, 'COD_ORDE', array('class' => 'form-control')); ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->label($model, 'COD_TIEN'); ?>
                    <?php echo $form->dropDownList($model, 'COD_TIEN', $model->ListaTiendaUpdate(), array('class' => 'form-control', 'empty' => 'Seleccionar Tienda')); ?>
                </div>
            </div>
            
            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <?php echo $form->label($model, 'FEC_EMIS'); ?>
                                        <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'FEC_EMIS',
                        'value' => $model->FEC_EMIS,
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Fecha de Envio'),
                        'options' => array(
                            'autoSize' => true,
                            'defaultDate' => $model->FEC_EMIS,
                            'dateFormat' => 'dd/mm/yy',
                            'buttonImageOnly' => true,
                            'buttonText' => 'FEC_EMIS',
                            'selectOtherMonths' => true,
                            'showAnim' => 'fadeIn', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            'showOtherMonths' => true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                            'maxDate' => "+20Y",
                        ),
                    ));
                    ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->label($model, 'IND_ESTA'); ?>
                    <?php echo $form->dropDownList($model, 'IND_ESTA', $model->Estado(), array('class' => 'form-control', 'empty' => 'Seleccionar Estado')); ?>
                </div>
            </div>

        </div>
            <br>
            
            <div class="panel-footer " style="overflow:hidden;text-align:right;">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-success btn-md')); ?>
                        <input type="reset" src="create" class="btn btn-default btn-md" value="Cancelar">
                    </div>
            </div> 
                </div>  

            </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->