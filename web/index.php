<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($appEnv = getenv('APPLICATION_ENV')) {
    define('APPLICATION_ENV', $appEnv);
} else {
    define('APPLICATION_ENV', 'localhost');
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

if (APPLICATION_ENV == 'test') {
    $config = require(__DIR__ . '/../config/web.php');
} else {
    $configCache = __DIR__ . '/../runtime/config.php';
    if (!file_exists($configCache)) {
        file_put_contents($configCache, serialize(require(__DIR__ . '/../config/web.php')));
    }
    $config = unserialize(file_get_contents($configCache));
}

(new yii\web\Application($config))->run();
