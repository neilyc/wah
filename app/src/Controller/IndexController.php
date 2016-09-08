<?php
namespace App\Controller;

use App\Controller\Controller;

class IndexController extends Controller
{
  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");

    $this->view->render($response, 'index/index.html.twig');
    return $response;
  }
}
