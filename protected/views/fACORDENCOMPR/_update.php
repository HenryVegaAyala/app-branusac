<?php
/* @var $this FACORDENCOMPRController */
/* @var $model FACORDENCOMPR */
/* @var $form CActiveForm */
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV2.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Modificar Presupuesto</h3>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'facordencompr-form',
            'enableAjaxValidation' => true,
        ));
        ?>  
        <?php
        echo $form->errorSummary($model);
        ?>

        <script>
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);

        </script>

        <div class="fieldset">

            <div class="form-group ir">
                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'NUM_ORDE'); ?>
                    <?php echo $form->textField($model, 'NUM_ORDE', array('maxlength' => 12, 'class' => 'form-control', 'placeholder' => 'N° de Orden', 'readonly' => 'true')); ?>
                </div>

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                    <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaClienteUpdate(), array('class' => 'form-control', 'disabled' => 'true')); ?>

                </div>

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
                    <?php echo $form->dropDownList($model, 'COD_TIEN', $model->ListaTiendaUpdate(), array('class' => 'form-control', 'disabled' => 'true')); ?>
                </div>                

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'TIP_MONE'); ?>
                    <?php echo $form->dropDownList($model, 'TIP_MONE', $model->Moneda(), array('class' => 'form-control', 'disabled' => 'true')); ?>
                </div>               
            </div>

            <div class="form-group ir">
                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'FEC_INGR'); 
                    $FI = $model->FEC_INGR;
                    $FIC = date("dd-mm-YY", strtotime($FI) );
                    ?>

                    <input type="text" id="FACORDENCOMPR_FEC_INGR" name="FACORDENCOMPR[FEC_INGR]" class="form-control" placeholder="Ingrese la Fecha Ingreso" value=" <?php echo $model->FEC_INGR ?>" readonly />
<!--                    <script>
                        $(function() {
                            $("#FACORDENCOMPR_FEC_INGR").datepicker();
                        });

                    </script>-->
                </div>

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'FEC_ENVI'); 
                    $FE = $model->FEC_ENVI;
                    $FEC = date("d-m-Y", strtotime($FE) );
                    ?>

                    <input type="text" id="FACORDENCOMPR_FEC_ENVI" name="FACORDENCOMPR[FEC_ENVI]" class="form-control" placeholder="Ingrese la Fecha Envio" value=" <?php echo $model->FEC_ENVI ?>" required="true"/>
                    <script>
                        $(function() {
                            $("#FACORDENCOMPR_FEC_ENVI").datepicker({minDate: 0});
                        });

                    </script>
                </div>

                <div class="col-sm-3 control-label">
                    <?php echo $form->textField($model, 'COD_ORDE', array('size' => 6, 'maxlength' => 6, 'style' => 'visibility: hidden')); ?>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;Datos del Cliente</legend>
            <div class="form-group ir">
                <?php
                $clie = $model->COD_CLIE;
                $tienda = $model->COD_TIEN;

                $connection = Yii::app()->db;
                $sqlStatement = "Select MC.NRO_RUC,MC.DES_CLIE,MT.DIR_TIEN from mae_clien MC, mae_tiend MT where  MC.COD_CLIE = MT.COD_CLIE and MT.COD_ESTA = 1 and MC.COD_ESTA = 1 and MC.COD_CLIE = $clie and MT.COD_TIEN = $tienda;";
                $command = $connection->createCommand($sqlStatement);
                $reader = $command->query();

                foreach ($reader as $row)
                ?>
                
                <div class="col-sm-4 control-label">
                    <label >RUC:</label>
                    <input type="text" value="<?php echo $row['NRO_RUC']?>" id="txtruc" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>RAZÓN SOCIAL:</label>
                    <input type="text" value="<?php echo $row['DES_CLIE']?>" id="txtRaZo" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>LUGAR DE ENTREGA:</label>
                    <input type="text" value="<?php echo $row['DIR_TIEN']?>" id="txtDIRE" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>
            </div>
        </div>
        <br>
        <div class="panel-footer " style="overflow:hidden;text-align:right;">
        </div>

        <div id="add container-fluid" >
            <?php
            include __DIR__ . '/../Recurso/Grilla2.php';
            ?>
        </div>

        <div class="container-fluid">
            <table align="right">
                <tbody>
                    <tr>
                        <td class="col-sm-4">
                            <?php echo $form->labelEx($model, 'TOT_MONT_ORDE'); ?>
                        </td>
                        <td>         
                            <?php
                            echo $form->textField($model, 'TOT_MONT_ORDE', array(
                                'value' => $model->SubTotal(),
                                'class' => 'form-control',
                                'style' => 'background-color: transparent;',
                                'readonly' => 'readonly'
                            ));
                            ?>
                            <?php echo $form->error($model, 'TOT_MONT_ORDE'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-sm-4">
                            <?php echo $form->labelEx($model, 'TOT_MONT_IGV'); ?>
                        </td>
                        <td>
                            <?php
                            echo $form->textField($model, 'TOT_MONT_IGV', array(
                                'value' => $model->Igv(),
                                'class' => 'form-control',
                                'style' => 'background-color: transparent;',
                                'readonly' => 'readonly'
                            ));
                            ?>
                            <?php echo $form->error($model, 'TOT_MONT_IGV'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-sm-4">
                            <?php echo $form->labelEx($model, 'TOT_FACT'); ?>
                        </td>
                        <td>                
                            <?php
                            echo $form->textField($model, 'TOT_FACT', array(
                                'value' => $model->Total(),
                                'class' => 'form-control',
                                'style' => 'background-color: transparent;',
                                'readonly' => 'readonly'
                            ))
                            ?>
                            <?php echo $form->error($model, 'TOT_FACT'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


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

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>