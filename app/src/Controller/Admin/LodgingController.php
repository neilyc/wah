<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Resource\LodgingResource;
use App\Entity\Lodging;

class LodgingController extends AdminController
{
  protected $lodgingResource = null;

  public function getLodgingResource() {
    if($this->lodgingResource == null) {
      $this->lodgingResource = new LodgingResource();
    }

    return $this->lodgingResource;
  }

  public function listAction($request, $response)
  {
    $this->logger->info('Admin lodging list action [start]');

    $this->context += array(
      'lodgings'  => $this->getLodgingResource()->get(),
    );

    $this->view->render($response, 'admin/lodging/list.html.twig', $this->context);
    $this->logger->info('Admin lodging list action [end]');
    return $response;
  }

  public function createAction($request, $response)
  {
    $this->logger->info('Admin lodging create action [start]');

    $this->view->render($response, 'admin/lodging/form.html.twig', $this->context);
    $this->logger->info('Admin lodging create action [end]');
    return $response;    
  }

  public function editAction($request, $response, $args)
  {
    $this->logger->info('Admin lodging edit action [start]');

    $lodging = $this->getLodgingResource()->get($args['id']);

    if(!$lodging) {
      return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_lodging_list'));
    }

    $this->context += array(
      'lodging'   => $lodging,
    );

    $this->view->render($response, 'admin/lodging/form.html.twig', $this->context);
    $this->logger->info('Admin lodging edit action [end]');
    return $response;    
  }

  public function saveAction($request, $response)
  {
    $this->logger->info('Admin lodging save action [start]');

    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $lodging = $this->getLodgingResource()->get($_REQUEST['id']);
    } else {
      $lodging = new Lodging();
    }

    $lodging->setDescription($_REQUEST['description']);
    $lodging->setPrice($_REQUEST['price']);

    if(isset($_FILES['image'])) {
      $lodging->uploadImage($_FILES['image']);
    }

    $id = $this->getLodgingResource()->persist($lodging);
    
    $this->flash->addMessage('save-lodging', 'La lodging a bien été enregistrée.');
    $this->logger->info('Admin lodging save action [end]');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_lodging_edit', array('id' => $id))
    );
  }

  public function deleteAction($request, $response, $args)
  {
    $this->logger->info('Admin lodging delete action [start]');

    $lodging = $this->getLodgingResource()->get($args['id']);

    if($lodging) {
      $this->getLodgingResource()->remove($lodging);
      $this->flash->addMessage('delete-lodging', 'La lodging a bien été supprimée.');
    }

    $this->logger->info('Admin lodging delete action [end]');
    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_lodging_list'));
  }
}
