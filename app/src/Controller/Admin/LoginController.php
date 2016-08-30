<?php
namespace App\Controller\Admin;

use Slim\Router;
use Slim\Views\Twig;
use Slim\Flash\Messages;
use Psr\Log\LoggerInterface;
use App\Helper\Session;
use App\Resource\UserResource;

final class LoginController
{
  private $view;
  private $logger;
  private $router;
  private $userResource;
  private $flash;
  private $session;

  public function __construct(
    Twig $view, 
    LoggerInterface $logger, 
    Router $router, 
    UserResource $userResource,
    Messages $flash
  )
  {
    $this->view = $view;
    $this->logger = $logger;
    $this->router = $router;
    $this->userResource = $userResource;
    $this->flash = $flash;
    $this->session = new Session();
  }

  public function indexAction($request, $response)
  {
    //$this->logger->info("Home page action dispatched");
    $this->view->render(
      $response, 
      'admin/login/login.html.twig', 
      array('message' => $this->flash->getMessage('check')[0])
    );
    return $response;
  }

  public function loginAction($request, $response)
  {
    $check = $this->userResource->check($_REQUEST['username'], $_REQUEST['password']);

    if($check['result']) {
      $this->session->set('user', $check['user']);
      return $response->withStatus(302)->withHeader('location', $this->router->pathFor('admin_index'));
    }

    $this->flash->addMessage('check', 'Veuillez vérifier les données saisies');

    return $response->withStatus(302)->withHeader('location', $this->router->pathFor('login_index'));
  }

  public function logoutAction($request, $response)
  {
    $this->session->remove('user');
    return $response->withStatus(302)->withHeader('location', $this->router->pathFor('admin_index'));
  }
}
