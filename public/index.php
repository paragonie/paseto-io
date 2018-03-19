<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

define('PASETO_IO_ROOT', dirname(__DIR__));

require PASETO_IO_ROOT . '/vendor/autoload.php';

session_start();

// Instantiate the app
/** @var array $settings */
$settings = require PASETO_IO_ROOT . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require PASETO_IO_ROOT . '/src/dependencies.php';

// Register middleware
require PASETO_IO_ROOT . '/src/middleware.php';

// Register routes
require PASETO_IO_ROOT . '/src/routes.php';

// Run app
$app->run();
