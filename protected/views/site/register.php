<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">
<?php
/* @var $this SiteController */
/* @var $model Usuario */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Registrarse';
$this->breadcrumbs = array(
    'Registrarse',
);
?>
<div class="row">
    <div class="col-md-12">
        <h1><p class="text-center">Registrarse</p></h1>
    </div>
</div>

<?php if (Yii::app()->user->hasFlash('ERROR')): ?>

    <div class="alert">
        <?php echo Yii::app()->user->getFlash('ERROR'); ?>
    </div>

<?php endif ?>

<div class="form-horizontal">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <div class="container-fluid " style="text-align: center;">

        <div class="form-group">
            <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2 control-label">
                <?php echo $form->labelEx($model, 'USE_USUA'); ?>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <?php echo $form->textField($model, 'USE_USUA', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'USE_USUA'); ?>
            </div>
        </div> 

        <div class="form-group">
            <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2 control-label">
                <?php echo $form->labelEx($model, 'PAS_USUA', array('class' => 'form-label')); ?>
            </div>      		
            <div class="col-xs-7 col-sm-7 col-md-6 col-lg-6">
                <?php echo $form->passwordField($model, 'PAS_USUA', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'PAS_USUA'); ?>
            </div> 			        	
        </div>

        <div class="form-group buttons">
            <div class="controls">
                <?php echo CHtml::submitButton('Registrarse', array('class' => 'btn btn-primary', 'icon' => 'ICON_HEART')); ?>
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

