<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests/codeception');

$params = require(__DIR__ . '/params.php');
$base   = require(__DIR__ . '/base.php');

$config = [
    'id' => 'basic-console',
    'controllerNamespace' => 'app\commands',
    'controllerMap'       => [
        'migrate' => [
            'class' => 'yii\mongodb\console\controllers\MigrateController',
            'db'    => 'mongodb',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

$config = yii\helpers\ArrayHelper::merge($base, $config,
    (APPLICATION_ENV && file_exists(__DIR__ . '/environments/' . APPLICATION_ENV . '/console.php')
        ? require(__DIR__ . '/environments/' . APPLICATION_ENV . '/console.php')
        : []), (file_exists(__DIR__ . '/local/console.php')
        ? require(__DIR__ . '/local/console.php')
        : []));

return $config;
