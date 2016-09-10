<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Resource\ServiceResource;

class ServiceController extends Controller
{
  protected $serviceResource = null;

  public function getServiceResource() {
    if($this->serviceResource == null) {
      $this->serviceResource = new ServiceResource();
    }

    return $this->serviceResource;
  }

  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      'services' => $this->getServiceResource()->get(),
    );

    $this->view->render($response, 'service/index.html.twig', $context);
    return $response;
  }
}