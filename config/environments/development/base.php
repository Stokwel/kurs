<?php

return [
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn'   => 'mongodb://localhost:27017/test'
        ]
    ]
];
