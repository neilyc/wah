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

  public function editAction($request, $response)
  {
    $this->context += array(
      'service'  => $this->getServiceResource()->get(1),
    );

    $this->view->render($response, 'admin/service/form.html.twig', $this->context);
    return $response;
  }

  public function saveAction($request, $response)
  {
    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $service = $this->getServiceResource()->get($_REQUEST['id']);
    } else {
      $service = new Service();
    }

    $service->setRestauration($_REQUEST['restauration']);
    $service->setAutre($_REQUEST['autre']);

    $id = $this->getServiceResource()->persist($service);
    
    $this->flash->addMessage('save-service', 'La service a bien été enregistrée.');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_service_edit', array('id' => $id))
    );
  }
}
