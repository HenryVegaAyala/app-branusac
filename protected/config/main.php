<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Imprenta Branusac',
    'language' => 'es',
//    'theme' => 'hebo',
    // preloading 'log' component
    'preload' => array('bootstrap', 'log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'alemana',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'generatorPaths' => array('bootstrap.gii')
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('site/login'),
        ),
        'session' => array(
            'class' => 'CDbHttpSession',
            'autoStart' => 'false',
            'cookieMode' => 'only',
            'timeout' => 1000
        ),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Booster',
            'responsiveCss' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'lista-presupuesto' => '/oc/index',
                'nuevo-presupuesto' => '/oc/create',
                'actualizar-presupuesto/<id:\d+>' => '/oc/update',
                'detalle-presupuesto/<id:\d+>' => '/oc/view/',
                'reporte-presupuesto/<id:\d+>' => '/oc/reporte',
                'generar-guia/<id:\d+>' => '/oc/procesar',

                'nueva-factura' => '/factura/create',
                'lista-factura' => '/factura/index',
                'detalle-factura/<id:\d+>' => '/factura/view',
                'actualizar-factura/<id:\d+>' => '/factura/update',
                'reporte-factura/<id:\d+>' => '/factura/reporte',

                'lista-guia' => '/guia/index',
                'actualizar-guia/<id:\d+>' => '/guia/update',
                'detalle-guia/<id:\d+>' => '/guia/view',
                'guia-anulada/<id:\d+>' => '/guia/Anular',
                'reporte-guia/<id:\d+>' => '/guia/reporte',
                'procesar-guia/<id:\d+>' => '/guia/procesar',

                'reporte-venta' => '/reporte/VentaProducto',
                'reporte-venta-producto' => '/reporte/ReporteVentaProducto',

                'ivg' => '/parametro/index',

                'folio' => '/folio/index',
                'actualizar-folio/<id:\d+>' => '/folio/update',

                'login' => '/site/login',

                '/' => '/site/index',
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => YII_DEBUG ? null : 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
