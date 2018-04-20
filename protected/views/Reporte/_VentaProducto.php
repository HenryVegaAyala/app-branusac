<div class="form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Reporte de Venta</h3>
        </div>

        <?php
        $url = Yii::app()->request->baseUrl;
        echo CHtml::beginForm('' . $url . '/reporte/ReporteVentaProducto', 'POST', array('id' => 'Reporte', 'name' => 'Reporte', 'target' => '_blank'));
        ?>

        <div class="container-fluid">
            <br>

            <div class="container-fluid">
                <p class="note">Los aspectos con <span class="required letra"> (*) </span> son requeridos.</p>
            </div>

            <div class="form-group">
                <div class="col-sm-3 ">
                    <h4><label>Fecha de Inicio:</label><span class="required letra"> (*) </span></h4>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'id' => 'Fecha_Ini',
                        'name' => 'Fecha_Ini',
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control  input-sm',
                            'placeholder' => 'Fecha Inicio', 'required',
                            'onChange' => 'Validar(this.value)', 'required'),
                        'options' => array(
                            'autoSize' => true,
                            'dateFormat' => 'dd/mm/yy',
                            'buttonImageOnly' => true,
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

                <div class="col-sm-3">
                    <h4><label>Fecha Fin:</label><span class="required letra"> (*) </span></h4>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'id' => 'Fecha_Fin',
                        'name' => 'Fecha_Fin',
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'form-control  input-sm', 'placeholder' => 'Fecha Final',
                            'disabled' => 'true',
                            'onChange' => 'mostrar(this.value)', 'required'),
                        'options' => array(
                            'autoSize' => true,
                            'dateFormat' => 'dd/mm/yy',
                            'buttonImageOnly' => true,
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

                <div class="col-sm-3">
                    <h4><label>Cliente:</label></h4>
                    <?php
                    $htmlCliente = array(
                        "ajax" => array(
                            "url" => CController::createUrl("/reporte/LoadCliente"),
                            "type" => "POST",
                            "update" => "#Cod_Tiend",
                        ),
                        'class' => 'form-control  input-sm',
                        'empty' => 'Seleccionar Cliente',
                    );
                    ?>
                    <?php echo CHtml::dropDownList('Cod_Clie', 'DES_CLIE', CHtml::listData(Cliente::model()->findAll(), 'COD_CLIE', 'DES_CLIE'), $htmlCliente);
                    ?>
                </div>


                <div class="col-sm-3">
                    <h4><label>Tienda:</label></h4>
                    <?php
                    $htmlTienda = array(
                        'class' => 'form-control  input-sm',
                        'empty' => 'Seleccionar Tienda',
                    );
                    ?>
                    <?php
                    echo CHtml::dropDownList('Cod_Tiend', 'DES_TIEND', CHtml::listData(Tienda::model()->findAll('COD_TIEN = 0'), 'COD_TIEN', 'DES_TIEN'), $htmlTienda);
                    ?>
                </div>
            </div>

        </div>

        <div class="container-fluid">

            <div class="form-group">
                <div class="col-sm-3 ">
                    <h4><label>Estado:</label></h4>
                    <?php
                    echo CHtml::dropDownList('Estado', 'DES_ESTA', array(
                        '1' => 'Emitida/Pendiente de Cobro',
                        '2' => 'Cobrada/Cerrada',
                        '9' => 'Anulado'), array(
                            'class' => 'form-control  input-sm',
                            'empty' => 'Seleccionar Cliente',)
                    );
                    ?>
                </div>


                <div class="col-sm-6">
                    <h4><label>Agrupación:</label></h4>

                    <?php
                    echo CHtml::radioButton('Agrupa', true, array(
                        'value' => '0',
                        'name' => 'Agrupa',
                        'uncheckValue' => null
                    ));
                    ?>
                    <label>Cliente</label>
                    &nbsp;
                    <?php
                    echo CHtml::radioButton('Agrupa', false, array(
                        'value' => '1',
                        'name' => 'Agrupa',
                        'uncheckValue' => null
                    ));
                    ?>
                    <label>Tienda</label>
                    &nbsp;
                    <?php
                    echo CHtml::radioButton('Agrupa', false, array(
                        'value' => '2',
                        'name' => 'Agrupa',
                        'uncheckValue' => null
                    ));
                    ?>
                    <label>Producto</label>

                </div>


            </div>
        </div>

        <br>

        <script>
            function Validar() {
                $('#Fecha_Fin').prop('disabled', false);
            }
            function mostrar() {
                $('#yw0').prop('disabled', false);
            }
        </script>

        <div class="panel-footer container-fluid" style="overflow:hidden;text-align:right;">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?php
                    $this->widget(
                        'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'success',
                        'label' => 'Ejecutar Reporte PDF',
                        'size' => 'default',
                        'icon' => 'fa fa-file-pdf-o',
                        'buttonType' => 'submit',
                        'htmlOptions' => array('target' => '_blank;', 'disabled ' => 'true')
                    ));
                    ?>
                    <?php // echo CHtml::submitButton('Ejecutar Reporte'); ?>
                    <?php
                    $this->widget(
                        'ext.bootstrap.widgets.TbButton', array(
                        'context' => 'default',
                        'label' => 'Limpiar',
                        'size' => 'default',
                        'icon' => 'fa fa-eraser',
                        'buttonType' => 'reset'
                    ));
                    ?>
                </div>
            </div>
        </div>

    </div>
    <?php echo CHtml::endForm(); ?>
</div><!-- form -->
