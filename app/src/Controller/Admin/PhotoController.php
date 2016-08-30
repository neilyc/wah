<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Resource\PhotoResource;
use App\Entity\Photo;

class PhotoController extends AdminController
{
  protected $photoResource = null;

  public function getPhotoResource() {
    if($this->photoResource == null) {
      $this->photoResource = new PhotoResource();
    }

    return $this->photoResource;
  }

  public function listAction($request, $response)
  {
    $this->logger->info('Home page action dispatched');

    $context = array(
      'photos'  => $this->getPhotoResource()->get(),
      'messages' => $this->flash->getMessages(),
    );

    $this->view->render($response, 'admin/photo/list.html.twig', $context);
    return $response;
  }

  public function createAction($request, $response)
  {
    $this->logger->info('Home page action dispatched');

    $this->view->render($response, 'admin/photo/create.html.twig');
    return $response;    
  }

  public function editAction($request, $response, $args)
  {
    $this->logger->info('Home page action dispatched');

    $photo = $this->getPhotoResource()->get($args['id']);

    if(!$photo) {
      return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_photo_list'));
    }

    $context = array(
      'photo'   => $photo,
      'messages' => $this->flash->getMessages(),
    );

    $this->view->render($response, 'admin/photo/edit.html.twig', $context);
    return $response;    
  }

  public function saveAction($request, $response)
  {
    if(isset($_REQUEST['id'])) {
      $photo = $this->getPhotoResource()->get($_REQUEST['id']);
    } else {
      $photo = new Photo();
    }

    $photo->setTitle($_REQUEST['title']);
    $photo->setImage($_REQUEST['image']);

    $id = $this->getPhotoResource()->persist($photo);

    $this->flash->addMessage('success', 'La photo a bien été enregistrée.');

    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_photo_edit', array('id' => $id))
    );
  }

  public function deleteAction($request, $response, $args)
  {
    $this->logger->info('Home page action dispatched');

    $photo = $this->getPhotoResource()->get($args['id']);

    if($photo) {
      $this->getPhotoResource()->remove($photo);
      $this->flash->addMessage('success', 'La photo a bien été supprimée.');
    }

    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_photo_list'));
  }
}
