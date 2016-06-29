<?php

$config = [
    'id' => 'ubs20-admin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'log'     => [
            'traceLevel' => YII_DEBUG
                ? 3
                : 0,
            'targets'    => [
                [
                    'class'   => 'yii\log\FileTarget',
                    'levels'  => [
                        'error',
                        'warning'
                    ],
                    'logVars' => []
                ],
            ],
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn'   => 'mongodb://ubs_local:123@localhost:27017/ubs_local'
        ],
        'dbForDump' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ubs',
            'username' => 'root',
            'password' => 'gw4t3sns',
            'charset' => 'utf8',
        ]
    ],
];

$config = yii\helpers\ArrayHelper::merge($config,
    (APPLICATION_ENV && file_exists(__DIR__ . '/environments/' . APPLICATION_ENV . '/base.php')
        ? require(__DIR__ . '/environments/' . APPLICATION_ENV . '/base.php')
        : []), (file_exists(__DIR__ . '/local/base.php')
        ? require(__DIR__ . '/local/base.php')
        : []));

return $config;
