<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Helper\Mailer;
use App\Resource\InfosResource;

class InfosController extends Controller
{
  protected $infosResource = null;

  public function getInfosResource() {
    if($this->infosResource == null) {
      $this->infosResource = new InfosResource();
    }

    return $this->infosResource;
  }

  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      'infos' => $this->getInfosResource()->get(1),
    );

    $this->view->render($response, 'infos/index.html.twig', $context);
    return $response;
  }

  public function contactAction($request, $response)
  {
    $mail = new Mailer();
    
    //var_dump($_REQUEST);die;
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      //'infos' => $this->getInfosResource()->get(),
    );

    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('infos_index'));
  }
}