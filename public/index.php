<?php
use Phalcon\Di\FactoryDefault;

//error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

//try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . "/config/services.php";

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    /**
     * Phalcon debug;
     * @see https://docs.phalconphp.com/en/latest/reference/debug.html#catching-exceptions
     */
    if(class_exists('\Phalcon\Debug') && $config->settings->development === TRUE) {
        $debug = new \Phalcon\Debug();
        $debug->listen();
    }

    /**
     * Phalcon Debugbar
     * @see https://github.com/snowair/phalcon-debugbar
     */
    if(class_exists('\Snowair\Debugbar\ServiceProvider') && $config->settings->development === TRUE) {
        $di['app'] = $application;

        $debugBarServiceProvider = new Snowair\Debugbar\ServiceProvider();
        $debugBarServiceProvider->start();
    }

    echo $application->handle()->getContent();

//} catch (\Exception $e) {
    //echo $e->getMessage() . '<br>';
    //echo '<pre>' . $e->getTraceAsString() . '</pre>';
//}
