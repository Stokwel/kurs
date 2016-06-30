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
    ],
];

$config = yii\helpers\ArrayHelper::merge($config,
    (APPLICATION_ENV && file_exists(__DIR__ . '/environments/' . APPLICATION_ENV . '/base.php')
        ? require(__DIR__ . '/environments/' . APPLICATION_ENV . '/base.php')
        : []), (file_exists(__DIR__ . '/local/base.php')
        ? require(__DIR__ . '/local/base.php')
        : []));

return $config;
