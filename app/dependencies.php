<?php
// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
  $settings = $c->get('settings');
  $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

  // Add extensions
  $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
  $view->addExtension(new Twig_Extension_Debug());

  return $view;
};

// Flash messages
$container['flash'] = function ($c) {
  return new \Slim\Flash\Messages;
};

// 404 error
$container['notFoundHandler'] = function ($c) { 
  return function ($request, $response) use ($c) {
    $c->get('logger')->error('404 - ' . $request->getUri()->getPath());
    return $c['view']->render($response, 'errors/404.html.twig')->withStatus(404); 
  }; 
};

$container['errorHandler'] = function ($c) {
  return function ($request, $response, $exception) use ($c) {
    $c->get('logger')->error('500 - Path : ' . $request->getUri()->getPath() . ' || Message : ' . $exception->getMessage());
    return $c['view']->render($response, 'errors/500.html.twig')->withStatus(500); 
  };
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
  $settings = $c->get('settings');
  $logger = new \Monolog\Logger($settings['logger']['name']);
  $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
  $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path_error'], \Monolog\Logger::ERROR));
  return $logger;
};

// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------


/* FRONT */
$container['App\Controller\IndexController'] = function ($c) {
  return new App\Controller\IndexController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};

$container['App\Controller\PhotoController'] = function ($c) {
  return new App\Controller\PhotoController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};

$container['App\Controller\LodgingController'] = function ($c) {
  return new App\Controller\LodgingController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};

$container['App\Controller\InfosController'] = function ($c) {
  return new App\Controller\InfosController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};


/* ADMIN */
$container['App\Controller\Admin\IndexController'] = function ($c) {
  return new App\Controller\Admin\IndexController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};

$container['App\Controller\Admin\LoginController'] = function ($c) {
  $userResource = new \App\Resource\UserResource();
  return new App\Controller\Admin\LoginController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'), $userResource);
};

$container['App\Controller\Admin\PhotoController'] = function ($c) {
  return new App\Controller\Admin\PhotoController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};

$container['App\Controller\Admin\LodgingController'] = function ($c) {
  return new App\Controller\Admin\LodgingController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};

$container['App\Controller\Admin\InfosController'] = function ($c) {
  return new App\Controller\Admin\InfosController($c->get('view'), $c->get('logger'), $c->get('router'), $c->get('flash'));
};