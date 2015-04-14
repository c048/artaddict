<?php

//Config
require 'config.php';

// spl_autoload_register = alternative
function __autoload($class) {
    if(file_exists(LIBS . $class. '.class.php')) {
        require LIBS . $class. '.class.php';
    } else if(file_exists(UTILS . $class. '.class.php')) {
        require UTILS . $class. '.class.php';
    }
}

// Load the Bootstrap
$bootstrap = new Bootstrap();

//Optional Path settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorPath();

// Start the Bootstrap
$bootstrap->init();