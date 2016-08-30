<?php
namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use App\Resource\PhotoResource;

final class PhotoController
{
  private $photoResource;
  private $view;
  private $logger;

  public function __construct(Twig $view, LoggerInterface $logger, PhotoResource $photoResource)
  {
    $this->view = $view;
    $this->logger = $logger;
    $this->photoResource = $photoResource;
  } 

  public function indexAction($request, $response, $args)
  {
    $this->logger->info("Home page action dispatched");
    
    $context = array(
      'photos' => $this->photoResource->get(),
    );

    $this->view->render($response, 'photo/index.html.twig', $context);
    return $response;
  }
}