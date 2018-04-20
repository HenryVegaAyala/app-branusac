<?php
/* @var $this FACFACTUController */
/* @var $model FACFACTU */
/* @var $form CActiveForm */
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV2.css">
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Modificar Factura</h3>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'facfactu-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
        ?>

        <div class="fieldset">
            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_FACT'); ?>
                    <?php echo $form->textField($model, 'COD_FACT', array('class' => 'form-control', 'readonly' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_FACT'); ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                    <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaCliente(), array('class' => 'form-control', 'empty' => 'Seleccionar Estado', 'disabled' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_CLIE'); ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'COD_GUIA'); ?>
                    <?php echo $form->textField($model, 'COD_GUIA', array('class' => 'form-control', 'readonly' => 'true')); ?>
                    <?php echo $form->error($model, 'COD_GUIA'); ?>
                </div>
            </div>

            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'FEC_FACT'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'FEC_FACT',
                        'value' => $model->FEC_FACT,
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Fecha Facturada', 'disabled' => 'true'),
                        'options' => array(
                            'autoSize' => true,
                            'defaultDate' => $model->FEC_FACT,
                            'dateFormat' => 'yy/mm/dd',
                            'buttonImageOnly' => true,
                            'buttonText' => 'FEC_FACT',
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
                    <?php echo $form->labelEx($model, 'FEC_PAGO'); ?>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'FEC_PAGO',
                        'value' => $model->FEC_PAGO,
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control', 'placeholder' => 'Fecha Ingreso'),
                        'options' => array(
                            'autoSize' => true,
                            'defaultDate' => $model->FEC_PAGO,
                            'dateFormat' => 'yy-mm-dd',
                            'buttonImageOnly' => true,
                            'buttonText' => 'FEC_PAGO',
                            'selectOtherMonths' => true,
                            'showAnim' => 'fadeIn', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                            'showOtherMonths' => true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                            'minDate' => 'date("Y-MM-DD")',
                            'maxDate' => "+20Y",
                        ),
                    ));
                    ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'IND_ESTA'); ?>
                    <?php echo $form->dropDownList($model, 'IND_ESTA', $model->Estado(), array('class' => 'form-control', 'empty' => 'Seleccionar Estado', 'disabled' => 'true')); ?>
                    <?php echo $form->error($model, 'IND_ESTA'); ?>
                </div>
            </div>
            <div class="container-fluid">
                <legend>&nbsp;&nbsp;&nbsp;&nbsp;Datos del Cliente</legend>
                <div class="form-group ir">
                    <?php
                    $clie = $model->COD_CLIE;

                    $connection = Yii::app()->db;
                    $sqlStatement = "SELECT distinct MC.NRO_RUC,MC.DES_CLIE,MT.DIR_TIEN FROM fac_factu F
                                    inner join mae_tiend MT on F.COD_CLIE = MT.COD_CLIE
                                    inner join mae_clien MC on MT.COD_CLIE = MC.COD_CLIE
                                    where F.COD_CLIE = $clie;";

                    $command = $connection->createCommand($sqlStatement);
                    $reader = $command->query();

                    foreach ($reader as $row)
                        
                        ?>

                    <div class="col-sm-4 control-label">
                        <label >RUC:</label>
                        <input type="text" value="<?php echo $row['NRO_RUC'] ?>" id="txtruc" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                    </div>

                    <div class="col-sm-4 control-label">
                        <label>RAZÓN SOCIAL:</label>
                        <input type="text" value="<?php echo $row['DES_CLIE'] ?>" id="txtRaZo" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                    </div>

                    <div class="col-sm-4 control-label">
                        <label>LUGAR DE ENTREGA:</label>
                        <input type="text" value="<?php echo $row['DIR_TIEN'] ?>" id="txtDIRE" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                    </div>
                </div>
            </div>
            <br>
            <div class="panel-footer">
            </div>
        </div>
        <br>
        <div class="container-fluid">

            <?php
            echo '<table class="table table-hover table-bordered table-condensed table-striped">';
            echo '<tr>';
            echo '<th style="text-align: center;" class="col-md-2">Codigo</th>';
            echo '<th style="text-align: center;" >Descripción</th>';
            echo '<th style="text-align: center;" class="col-md-1">Cantidad</th>';
            echo '<th style="text-align: center;" class="col-md-1">Precio</th>';
            echo '<th style="text-align: center;" class="col-md-1">Precio</th>';
            echo '</tr>';
            $sqlStatement = "SELECT F.COD_PROD, M.DES_LARG,F.UNI_SOLI,F.VAL_PROD,F.IMP_PROD FROM fac_detal_factu F
            inner join mae_produ M on F.COD_PROD = M.COD_PROD
            where F.COD_FACT = '" . $model->COD_FACT . "';";

            $connection = Yii::app()->db;
            $command = $connection->createCommand($sqlStatement);
            $reader = $command->query();
            while ($row1 = $reader->read()) {
                echo '<tr>';
                echo '<td>' . $row1['COD_PROD'] . '</td>';
                echo '<td>' . $row1['DES_LARG'] . '</td>';
                echo '<td>' . $row1['UNI_SOLI'] . '</td>';
                echo '<td>' . $row1['VAL_PROD'] . '</td>';
                echo '<td>' . $row1['IMP_PROD'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
            ?>
        </div>
        <br>
        <div class="panel-footer container-fluid" style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', array('class' => 'btn btn-success btn-md')); ?>
                    <?php
                    $this->widget(
                            'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'default',
                        'label' => 'Regresar',
                        'size' => 'default',
                        'buttonType' => 'link',
                        'url' => array('index')
                    ));
                    ?>
                </div>
            </div>  
        </div>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->
