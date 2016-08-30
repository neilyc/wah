<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;

class IndexController extends AdminController
{
  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");

    $this->view->render($response, 'admin/index/index.html.twig');
    return $response;
  
  }
}
