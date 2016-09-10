<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Resource\ServiceResource;
use App\Entity\Service;

class ServiceController extends AdminController
{
  protected $serviceResource = null;

  public function getServiceResource() {
    if($this->serviceResource == null) {
      $this->serviceResource = new ServiceResource();
    }

    return $this->serviceResource;
  }

  public function listAction($request, $response)
  {
    $this->logger->info('Admin service list action [start]');

    $this->context += array(
      'services'  => $this->getServiceResource()->get(),
    );

    $this->view->render($response, 'admin/service/list.html.twig', $this->context);
    $this->logger->info('Admin service list action [end]');
    return $response;
  }

  public function createAction($request, $response)
  {
    $this->logger->info('Admin service create action [start]');

    $this->view->render($response, 'admin/service/form.html.twig', $this->context);
    $this->logger->info('Admin service create action [end]');
    return $response;    
  }

  public function editAction($request, $response, $args)
  {
    $this->logger->info('Admin service edit action [start]');

    $service = $this->getServiceResource()->get($args['id']);

    if(!$service) {
      return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_service_list'));
    }

    $this->context += array(
      'service'   => $service,
    );

    $this->view->render($response, 'admin/service/form.html.twig', $this->context);
    $this->logger->info('Admin service edit action [end]');
    return $response;    
  }

  public function saveAction($request, $response)
  {
    $this->logger->info('Admin service save action [start]');

    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $service = $this->getServiceResource()->get($_REQUEST['id']);
    } else {
      $service = new Service();
    }

    $service->setTitle($_REQUEST['title']);

    if(isset($_FILES['image'])) {
      $service->uploadImage($_FILES['image']);
    }

    $id = $this->getServiceResource()->persist($service);
    
    $this->flash->addMessage('save-service', 'La service a bien été enregistrée.');
    $this->logger->info('Admin service save action [end]');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_service_edit', array('id' => $id))
    );
  }

  public function deleteAction($request, $response, $args)
  {
    $this->logger->info('Admin service delete action [start]');

    $service = $this->getServiceResource()->get($args['id']);

    if($service) {
      $this->getServiceResource()->remove($service);
      $this->flash->addMessage('delete-service', 'La service a bien été supprimée.');
    }

    $this->logger->info('Admin service delete action [end]');
    return $response->withStatus(302)->withHeader('Location', $this->router->pathFor('admin_service_list'));
  }
}
