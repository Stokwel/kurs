<?php

return [
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn'   => 'mongodb://localhost:27017/ubs'
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
