<?php

if (PHP_SAPI == 'cli-server') {
  // To help the built-in PHP dev server, check if the request was actually for
  // something which should probably be served as a static file
  $file = __DIR__ . $_SERVER['REQUEST_URI'];
  if (is_file($file)) {
      return false;
  }
}

$baseDir = __DIR__ . '/../';

require $baseDir . 'vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require $baseDir . 'app/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require $baseDir . 'app/dependencies.php';

// Register middleware
require $baseDir . 'app/middleware.php';

// Register routes
require $baseDir . 'app/routes.php';

// Run!
$app->run();
