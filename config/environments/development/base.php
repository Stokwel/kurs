<?php

return [
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn'   => 'mongodb://ubs_dev:MmjL3dvy0N@dev3-mongo3.co.nevosoft.ru:27057/ubs_dev'
        ],
        'dbForDump' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ubs',
            'username' => 'ubs',
            'password' => 'biuyeejethiher',
            'charset' => 'utf8',
        ]
    ]
];
