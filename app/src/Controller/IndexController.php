<?php
namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;

final class IndexController
{
  private $view;
  private $logger;

  public function __construct(Twig $view, LoggerInterface $logger)
  {
    $this->view = $view;
    $this->logger = $logger;
  }

  public function indexAction($request, $response, $args)
  {
    $this->logger->info("Home page action dispatched");

    $this->view->render($response, 'index/index.html.twig');
    return $response;
  }
}
