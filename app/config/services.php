<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Security;
use PhalconTime\Controllers\Component\UserFragment;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return require APP_PATH . "/config/config_dev.php";
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $connection = new $class([
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname//,
        //'charset'  => $config->database->charset
    ]);

    return $connection;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            if($config->settings->development === FALSE) {
                $volt->setOptions([
                    'compiledPath' => $config->application->cacheDir,
                    'compiledSeparator' => '_',
                    'compileAlways' => FALSE
                ]);
            }

            if($config->settings->development === TRUE) {
                array_map('unlink', glob($config->application->cacheDir . '*.php'));
                $volt->setOptions([
                    'compiledSeparator' => '_',
                    'compileAlways' => TRUE
                ]);
            }

            // Custom volt functions
            $compiler = $volt->getCompiler();
            $compiler->addFunction('split', 'explode');

            return $volt;
        },
        '.phtml' => PhpEngine::class // php >= 5.5 only
        //'.phtml' => 'Phalcon\Mvc\View\Engine\Php' // php <= php 5.4 work-around

    ]);

    return $view;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Loading routes from the routes.php file
 */
$di->set('router', function () {
    return require APP_PATH . '/config/routes.php';
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    $config = $this->getConfig();
    return new MetaDataAdapter([
        'metaDataDir' => $config->application->cacheDir . 'metaData/'
    ]);
    //return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Phalcon\Flash\Session([
        'error'   => 'alert alert-danger alert-dismissible',
        'success' => 'alert alert-success alert-dismissible',
        'notice'  => 'alert alert-info alert-dismissible',
        'warning' => 'alert alert-warning alert-dismissible'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Start security component
 * Set the password hashing factor to 12 rounds (higher, means better security but slower performance)
 */
$di->set('security', function () {
    $security = new Security();
    $security->setWorkFactor(12);

    return $security;
}, true);

/**
 * Register UserFragment
 * the fragment can be used to display a user list
 */
$di->set('fragment', function() {
    return new UserFragment();
});
