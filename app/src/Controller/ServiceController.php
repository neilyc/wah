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
    $context = array(
      'service' => $this->getServiceResource()->get(1),
    );

    $this->view->render($response, 'service/index.html.twig', $context);
    return $response;
  }
}