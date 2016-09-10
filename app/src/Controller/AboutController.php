<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Helper\Mailer;
use App\Resource\AboutResource;

class AboutController extends Controller
{
  protected $aboutResource = null;

  public function getAboutResource() {
    if($this->aboutResource == null) {
      $this->aboutResource = new AboutResource();
    }

    return $this->aboutResource;
  }

  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      'about' => $this->getAboutResource()->get(1),
    );

    $this->view->render($response, 'about/index.html.twig', $context);
    return $response;
  }
}