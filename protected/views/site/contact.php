<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stylev2.css">
<center><h1><i>Página en Construcción</i></h1></center>

<div class="container-fluid">
    <center>
        <img align="center" hspace="10" src="<?php echo Yii:: app()->baseUrl . '/images/pagina-en-construccion.gif' ?>">
        <br>
        <br>
    </center>
</div>

<?php
$user = Yii::app()->getComponent('user');

$user->setFlash(
        'error', '<center><strong>No se puede conectar a la base de datos, Asegúrese que esté conectada</center>'
);


$this->widget('booster.widgets.TbAlert', array(
    'fade' => true,
    'closeText' => '&times;',
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array(
        'error' => array('closeText' => false)
    ),
));



?>
<br><br><br>