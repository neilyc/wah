<?php
namespace App\Controller;

use Slim\Router;
use Slim\Views\Twig;
use Slim\Flash\Messages;
use Psr\Log\LoggerInterface;
use App\Helper\Session;

class Controller
{
  protected $view;
  protected $logger;
  protected $router;
  protected $flash;
  protected $session;
  protected $context = array();

  public function __construct(Twig $view, LoggerInterface $logger, Router $router, Messages $flash)
  {
    $this->router = $router;
    $this->view = $view;
    $this->logger = $logger;
    $this->flash = $flash;

    if(count($this->flash->getMessages()) > 0) {
      $this->context += array('messages' => $this->flash->getMessages());
    }
  }
}
