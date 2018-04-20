<br>
<?php
$user = Yii::app()->getComponent('user');
$user->setFlash(
        'success', "<strong>La migración de Presupuesto a Guia fue exitosa.</strong>"
);

// Render them all with single `TbAlert`
$this->widget('booster.widgets.TbAlert', array(
    'fade' => true,
    'closeText' => '&times;', // false equals no close link
    'events' => array(),
    'htmlOptions' => array(),
    'userComponentId' => 'user',
    'alerts' => array(// configurations per alert type
        // success, info, warning, error or danger
        'success' => array('closeText' => 'Ir a la Guia'),
    ),
));