<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login/animate-custom.css">

<div class="form">
    <?php
    $this->setPageTitle('Login');
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="container" id="login-block">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">

                <div class="login-box clearfix animated flipInY">
                    <div class="login-logo">
                        <center>
                            <a href="">
                                <img align="center"  style=" width: 310px; height: 60px;" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/logo.png' ?>"></a>
                        </center>
                    </div>

                    <div class="login-form">

                        <?php echo $form->textField($model, 'username', array(
                            'maxlength' => 10,
                            'class' => 'form-control',
                            'placeholder' => 'Usuario',
                        )); ?>
                        <span class="required">
                            <center>
                                <?php echo $form->error($model, 'username'); ?>
                            </center>
                            <br>
                        </span>

                        <?php echo $form->passwordField($model, 'password', array(
                            'maxlength' => 10,
                            'class' => 'form-control',
                            'placeholder' => 'Contraseña',
                        )); ?>

                        <span class="required">
                            <center>
                                <?php echo $form->error($model, 'password'); ?>
                            </center>
                        </span>

                        <button type="submit" name="btn-login" class="btn btn-block btn-red">
                            <i class="glyphicon glyphicon-log-in"></i>&nbsp;Inicia Sesión
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
