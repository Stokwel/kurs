<?php

defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'windows'));

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

# Set the internal character encoding
mb_internal_encoding('UTF-8');

# We're in XXI century, so let's use modern locale already
setlocale(
    LC_CTYPE,
    'C.UTF-8', // libc >= 2.13
    'C.utf8', // different spelling
    'en_US.UTF-8', // fallback to lowest common denominator
    'en_US.utf8' // different spelling for fallback
);

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

