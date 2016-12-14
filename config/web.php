<?php

$params = require(__DIR__ . '/params.php');
$base   = require(__DIR__ . '/base.php');

$config = [
    'defaultRoute' => 'site/index',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'xp7bWdSyA3NgoQ82hIjCEvPzLSEeMLJg',
            'baseUrl' => ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\components\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            //'scriptUrl'=>'/index.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'mongoDbModel' => [
                'class' => 'yii\mongodb\gii\model\Generator'
            ]
        ]
    ];

    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

$config = yii\helpers\ArrayHelper::merge($base, $config,
    (APPLICATION_ENV && file_exists(__DIR__ . '/environments/' . APPLICATION_ENV . '/web.php')
        ? require(__DIR__ . '/environments/' . APPLICATION_ENV . '/web.php')
        : []), (file_exists(__DIR__ . '/local/web.php')
        ? require(__DIR__ . '/local/web.php')
        : []));

unset($base);

return $config;
