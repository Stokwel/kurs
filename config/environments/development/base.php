<?php

return [
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn'   => 'mongodb://ubs_dev:MmjL3dvy0N@dev3-mongo.co.nevosoft.ru:27057/ubs_dev'
        ],
        'dbForDump' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ubs',
            'username' => 'root',
            'password' => 'gw4t3sns',
            'charset' => 'utf8',
        ]
    ]
];
