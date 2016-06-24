<?php

$params = require(__DIR__ . '/params.php');
$base   = require(__DIR__ . '/base.php');

$config = [
    'defaultRoute' => 'game',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'xp7bWdSyA3NgoQ82hIjCEvPzLSEeMLJg',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'panels' => [
            'mongodb' => [
                'class' => 'yii\mongodb\debug\MongoDbPanel',
            ]
        ]
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'mongoDbModel' => [
                'class' => 'yii\mongodb\gii\model\Generator'
            ]
        ]
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
