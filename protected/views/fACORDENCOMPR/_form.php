<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styleV2.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Registrar Nuevo Presupuesto</h3>
        </div>

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'facordencompr-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <br>
        <?php if (Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
        <?php endif ?>

        <div class="container-fluid">
            <p class="note">Los aspectos con <span class="required letra"> (*) </span> son requeridos.</p>
        </div>

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
                    <?php echo $form->textField($model, 'NUM_ORDE', array('maxlength' => 12, 'class' => 'form-control', 'placeholder' => 'N° de Orden')); ?>
                    <?php // echo $form->error($model, 'NUM_ORDE'); ?>
                </div>

                <div class="col-sm-3 control-label">

                    <?php
                    $htmlOptions = array(
                        "ajax" => array(
                            "url" => $this->createUrl("ClienteByTienda"),
                            "type" => "POST",
//                            "data" => array('COD_CLIE' => 'js:this.value'),
                            "update" => "#FACORDENCOMPR_COD_TIEN"
                        ),
                        'class' => 'form-control',
                        'empty' => 'Seleccionar Cliente',
                    );
                    ?>
                    <?php echo $form->labelEx($model, 'COD_CLIE'); ?>
                    <?php echo $form->dropDownList($model, 'COD_CLIE', $model->ListaCliente(), $htmlOptions); ?>

                </div>

                <div class="col-sm-3 control-label">
                    <?php
                    $htmlOption = array(
                        "ajax" => array(
                            "url" => $this->createUrl("ValorTienda"),
                            "type" => "POST",
//                            "update" => "#txtruc, txtRaZo,txtDIRE",
                            // "data" => array('COD_TIEN' => 'js:this.value'),
                            "success" => "function(data){   
                                
                            cadena = data.split('/');    

                           var ruc=document.getElementById('txtruc');
                           ruc.value= cadena[0];

                           var razo=document.getElementById('txtRaZo');
                           razo.value= cadena[1];
                           
                            var dire=document.getElementById('txtDIRE');
                           dire.value= cadena[2];     

                           }
                            "
                        ),
                        'class' => 'form-control',
                        'empty' => 'Seleccionar Tienda',
                        'onclick' => 'mostrar(this.value)',
                    );
                    ?>
                    <?php echo $form->labelEx($model, 'COD_TIEN'); ?>
                    <?php echo $form->dropDownList($model, 'COD_TIEN', $model->ListaTienda($model->COD_CLIE), $htmlOption); ?>
                    <?php // echo $form->error($model, 'COD_TIEN'); ?>

                </div>      

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'TIP_MONE'); ?>
                    <?php echo $form->dropDownList($model, 'TIP_MONE', $model->Moneda(), array('class' => 'form-control')); ?>
                    <?php // echo $form->error($model, 'TIP_MONE'); ?>
                </div>               
            </div>

            <div class="form-group ir">
                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'FEC_INGR'); ?>

                    <input type="text" id="FACORDENCOMPR_FEC_INGR" name="FACORDENCOMPR[FEC_INGR]" class="form-control" placeholder="Ingrese la Fecha Ingreso" value=" <?php $model->FEC_INGR ?>" required="true"/>
                    <script>
                        $(function() {
                            $("#FACORDENCOMPR_FEC_INGR").datepicker();
                        });

                    </script>
                    <?php // echo $form->error($model, 'FEC_INGR');  ?>
                </div>

                <div class="col-sm-3 control-label">
                    <?php echo $form->labelEx($model, 'FEC_ENVI'); ?>

                    <input type="text" id="FACORDENCOMPR_FEC_ENVI" name="FACORDENCOMPR[FEC_ENVI]" class="form-control" placeholder="Ingrese la Fecha Envio" value=" <?php $model->FEC_ENVI ?>" required="true"/>
                    <script>
                        $(function() {
                            $("#FACORDENCOMPR_FEC_ENVI").datepicker();
                        });

                    </script>
                    <?php // echo $form->error($model, 'FEC_ENVI');  ?>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <legend>&nbsp;&nbsp;&nbsp;&nbsp;Datos del Cliente</legend>
            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <label >RUC:</label>
                    <input type="text" id="txtruc" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>RAZÓN SOCIAL:</label>
                    <input type="text" id="txtRaZo" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>

                <div class="col-sm-4 control-label">
                    <label>LUGAR DE ENTREGA:</label>
                    <input type="text" id="txtDIRE" class="form-control" style="border:none; background-color: transparent;" disabled="true"/>
                </div>
            </div>
        </div>
        <br>
        <div class="panel-footer " style="overflow:hidden;text-align:right;">
        </div>

        <script>
            function mostrar(id) {
                if (id > 0) {
                    $("#add").show();
                }
            }
        </script>    

        <div id="add" style="display: none">
            <?php
            include __DIR__ . '/../Recurso/Grilla.php';
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
                    <?php
                    echo CHtml::submitButton(
                            $model->isNewRecord ? 'Guardar' : 'Guardar', array('class' => 'btn btn-success btn-md icon-user')
                    );
                    ?>
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