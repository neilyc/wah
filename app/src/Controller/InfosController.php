<?php
namespace App\Controller;

use App\Controller\Controller;
//use App\Resource\InfosResource;

class InfosController extends Controller
{
/*  protected $photoResource = null;

  public function getInfosResource() {
    if($this->photoResource == null) {
      $this->photoResource = new InfosResource();
    }

    return $this->photoResource;
  }
*/
  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      //'photos' => $this->getInfosResource()->get(),
    );

    $this->view->render($response, 'infos/index.html.twig', $context);
    return $response;
  }

  public function contactAction($request, $response)
  {
    var_dump($_REQUEST);die;
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      //'photos' => $this->getInfosResource()->get(),
    );

    $this->view->render($response, 'infos/index.html.twig', $context);
    return $response;
  }
}