<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Resource\PhotoResource;

class PhotoController extends Controller
{
  protected $photoResource = null;

  public function getPhotoResource() {
    if($this->photoResource == null) {
      $this->photoResource = new PhotoResource();
    }

    return $this->photoResource;
  }

  public function indexAction($request, $response)
  {
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      'photos' => $this->getPhotoResource()->get(),
    );

    $this->view->render($response, 'photo/index.html.twig', $context);
    return $response;
  }
}