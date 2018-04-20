<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">

<?php
/* @var $this SiteController */
/* @var $model ChangeForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Cambiar Contraseña';
$this->breadcrumbs = array(
    'Cambiar Contraseña',
);
?>

<div class="row">
    <div class="col-md-12">
        <h1><p class="text-center">Cambiar Contraseña</p></h1>
    </div>
</div>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="alert">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif ?>


<div class="container-fluid">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

        <div class="fieldset">
            <div class="form-group ir">
                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'placeholder' => 'Ingrese el Nombre del Analista')); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>

                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'password_new'); ?>
                    <?php echo $form->passwordField($model, 'password_new', array('class' => 'form-control', 'placeholder' => 'Ingrese el Correo Electrónico')); ?>
                    <?php echo $form->error($model, 'password_new'); ?>
                </div>
                
                                <div class="col-sm-4 control-label">
                    <?php echo $form->labelEx($model, 'password_new_repeat'); ?>
                    <?php echo $form->passwordField($model, 'password_new_repeat', array('class' => 'form-control', 'placeholder' => 'Ingrese el Correo Electrónico')); ?>
                    <?php echo $form->error($model, 'password_new_repeat'); ?>
                </div>
            </div>
        </div>
        </div>
                <div class="container-fluid">
                <p class="note invisible">Aqui va un salto de linea invisible</p>
            </div>
    
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton('Cambiar Contraseña' , array('class' => 'btn btn-default btn-md')); ?>
                    </div>
                </div>  


    <?php $this->endWidget(); ?>
</div><!-- form -->
