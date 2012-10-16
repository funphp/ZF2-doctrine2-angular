<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

chdir(dirname(__DIR__));
error_reporting(E_ALL); ini_set('display_errors', '1');
// Setup autoloading
include 'init_autoloader.php';
Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array(
    'namespaces' => array(
        'ZendOAuth' => dirname(__DIR__) . '/vendor/ZendOAuth',
    )
)));

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run();
