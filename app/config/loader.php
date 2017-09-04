<?php
$loader = new \Phalcon\Loader();

/**
 * Register directories for the Phalcon autoloader
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->formsDir
    ]
);

/**
 * Register custom namespaces for the Phalcon autoloader
 */
$loader->registerNamespaces(array(
  'PhalconTime\Models' => $config->application->modelsDir,
  'PhalconTime\Controllers' => $config->application->controllersDir,
  'PhalconTime\Forms' => $config->application->formsDir,
  'PhalconTime\Forms\Elements' => $config->application->formsElementsDir
));

/**
 * Register Files, Composer autoloader
 */
$loader->registerFiles(
    [
        APP_PATH . '/vendor/autoload.php'
    ]
);

/**
 * Register Composer autoloader
 */
$loader->register();
