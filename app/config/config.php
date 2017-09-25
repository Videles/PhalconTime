<?php
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => '',
        'password'    => '',
        'dbname'      => '',
        //'charset'     => 'utf8_general_ci',
    ],
    'application' => [
        'appDir'            => APP_PATH . '/',
        'controllersDir'    => APP_PATH . '/controllers/',
        'modelsDir'         => APP_PATH . '/models/',
        'viewsDir'          => APP_PATH . '/views/',
        'formsDir'          => APP_PATH . '/forms/',
        'formsElementsDir'  => APP_PATH . '/forms/elements/',
        'vendorDir'         => APP_PATH . '/vendor/',
        'cacheDir'          => BASE_PATH . '/cache/',
        'baseUri'           => '/phalcon-time/',
        'domainUri'         => 'http://yourdomain/phalcon-time'
    ],
    'settings' => [
        'development'    => FALSE,
    ]
]);
