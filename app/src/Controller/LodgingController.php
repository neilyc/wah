<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Resource\LodgingResource;

class LodgingController extends Controller
{
  protected $lodgingResource = null;

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
    );

    $this->view->render($response, 'lodging/index.html.twig', $context);
    return $response;
  }
}