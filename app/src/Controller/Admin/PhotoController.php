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
    $this->logger->info('Admin photo list action [start]');

    $this->context += array(
      'photos'  => $this->getPhotoResource()->get(),
    );

    $this->view->render($response, 'admin/photo/list.html.twig', $this->context);
    $this->logger->info('Admin photo list action [end]');
    return $response;
  }

  public function createAction($request, $response)
  {
    $this->logger->info('Admin photo create action [start]');

    $this->view->render($response, 'admin/photo/form.html.twig', $this->context);
    $this->logger->info('Admin photo create action [end]');
    return $response;    
  }

  public function editAction($request, $response, $args)
  {
    $this->logger->info('Admin photo edit action [start]');

    $photo = $this->getPhotoResource()->get($args['id']);

    if(!$photo) {
      return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_photo_list'));
    }

    $this->context += array(
      'photo'   => $photo,
    );

    $this->view->render($response, 'admin/photo/form.html.twig', $this->context);
    $this->logger->info('Admin photo edit action [end]');
    return $response;    
  }

  public function saveAction($request, $response)
  {
    $this->logger->info('Admin photo save action [start]');
    
    set_time_limit(0);

    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $photo = $this->getPhotoResource()->get($_REQUEST['id']);
    } else {
      $photo = new Photo();
    }

    $photo->setTitle($_REQUEST['title']);

    if(isset($_FILES['image'])) {
      $photo->uploadImage($_FILES['image']);
    }

    $id = $this->getPhotoResource()->persist($photo);
    
    $this->flash->addMessage('save-photo', 'La photo a bien été enregistrée.');
    $this->logger->info('Admin photo save action [end]');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_photo_edit', array('id' => $id))
    );
  }

  public function deleteAction($request, $response, $args)
  {
    $this->logger->info('Admin photo delete action [start]');

    $photo = $this->getPhotoResource()->get($args['id']);

    if($photo) {
      $this->getPhotoResource()->remove($photo);
      $this->flash->addMessage('delete-photo', 'La photo a bien été supprimée.');
    }

    $this->logger->info('Admin photo delete action [end]');
    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_photo_list'));
  }
}
