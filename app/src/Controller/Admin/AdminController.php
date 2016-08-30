<?php
namespace App\Controller\Admin;

use Slim\Router;
use Slim\Views\Twig;
use Slim\Flash\Messages;
use Psr\Log\LoggerInterface;
use App\Helper\Session;

class AdminController
{
  protected $view;
  protected $logger;
  protected $router;
  protected $flash;
  protected $session;

  public function __construct(Twig $view, LoggerInterface $logger, Router $router, Messages $flash)
  {
    $this->router = $router;
    $this->session = new Session();

    if(!$this->session->get('user')) {
      header('Status: 302', false, 302);      
      header('Location: ' . $this->router->pathFor('login_index'));      
      exit();
    }

    $this->view = $view;
    $this->logger = $logger;
    $this->flash = $flash;
  }
}
