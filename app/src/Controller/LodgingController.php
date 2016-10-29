<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Resource\LodgingResource;
use App\Resource\LodgingInfosResource;

class LodgingController extends Controller
{
  protected $lodgingResource = null;
  protected $lodgingInfosResource = null;

  public function getLodgingInfosResource() {
    if($this->lodgingInfosResource == null) {
      $this->lodgingInfosResource = new LodgingInfosResource();
    }

    return $this->lodgingInfosResource;
  }
  public function getLodgingResource() {
    if($this->lodgingResource == null) {
      $this->lodgingResource = new LodgingResource();
    }

    return $this->lodgingResource;
  }

  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      'lodgings' => $this->getLodgingResource()->get(),
      'infos' => $this->getLodgingInfosResource()->get(1),
    );

    $this->view->render($response, 'lodging/index.html.twig', $context);
    return $response;
  }
}