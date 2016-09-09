<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Resource\InfoResource;
use App\Entity\Info;

class InfosController extends AdminController
{
  protected $infoResource = null;

  public function getInfoResource() {
    if($this->infoResource == null) {
      $this->infoResource = new InfoResource();
    }

    return $this->infoResource;
  }

  public function listAction($request, $response)
  {
    $this->logger->info('Admin info list action [start]');

    $this->context += array(
      'infos'  => $this->getInfoResource()->get(),
    );

    $this->view->render($response, 'admin/info/list.html.twig', $this->context);
    $this->logger->info('Admin info list action [end]');
    return $response;
  }

  public function createAction($request, $response)
  {
    $this->logger->info('Admin info create action [start]');

    $this->view->render($response, 'admin/info/form.html.twig', $this->context);
    $this->logger->info('Admin info create action [end]');
    return $response;    
  }

  public function editAction($request, $response, $args)
  {
    $this->logger->info('Admin info edit action [start]');

    $info = $this->getInfoResource()->get($args['id']);

    if(!$info) {
      return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_info_list'));
    }

    $this->context += array(
      'info'   => $info,
    );

    $this->view->render($response, 'admin/info/form.html.twig', $this->context);
    $this->logger->info('Admin info edit action [end]');
    return $response;    
  }

  public function saveAction($request, $response)
  {
    $this->logger->info('Admin info save action [start]');

    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $info = $this->getInfoResource()->get($_REQUEST['id']);
    } else {
      $info = new Info();
    }

    $info->setTitle($_REQUEST['title']);

    if(isset($_FILES['image'])) {
      $info->uploadImage($_FILES['image']);
    }

    $id = $this->getInfoResource()->persist($info);
    
    $this->flash->addMessage('save-info', 'La info a bien été enregistrée.');
    $this->logger->info('Admin info save action [end]');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_info_edit', array('id' => $id))
    );
  }

  public function deleteAction($request, $response, $args)
  {
    $this->logger->info('Admin info delete action [start]');

    $info = $this->getInfoResource()->get($args['id']);

    if($info) {
      $this->getInfoResource()->remove($info);
      $this->flash->addMessage('delete-info', 'La info a bien été supprimée.');
    }

    $this->logger->info('Admin info delete action [end]');
    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_info_list'));
  }
}
