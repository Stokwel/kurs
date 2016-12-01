<?php

if ($appEnv = getenv('APPLICATION_ENV')) {
    define('APPLICATION_ENV', $appEnv);
} else {
    define('APPLICATION_ENV', 'local');
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$configCache = __DIR__ . '/../runtime/config.php';
if (APPLICATION_ENV != 'production' || !file_exists($configCache)) {
    $config = require(__DIR__ . '/../config/web.php');

    file_put_contents($configCache, serialize($config));
}
else {
    $config = unserialize(file_get_contents($configCache));
}

(new yii\web\Application($config))->run();
