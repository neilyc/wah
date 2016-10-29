<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Resource\InfosResource;
use App\Entity\Infos;

class InfosController extends AdminController
{
  protected $infosResource = null;

  public function getInfosResource() {
    if($this->infosResource == null) {
      $this->infosResource = new InfosResource();
    }

    return $this->infosResource;
  }

  public function editAction($request, $response)
  {
    $this->logger->info('Admin info list action [start]');

    $this->context += array(
      'infos'  => $this->getInfosResource()->get(1),
    );

    $this->view->render($response, 'admin/infos/edit.html.twig', $this->context);
    $this->logger->info('Admin info list action [end]');
    return $response;
  }

  public function saveAction($request, $response)
  {
    $this->logger->info('Admin info save action [start]');

    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $info = $this->getInfosResource()->get($_REQUEST['id']);
    } else {
      $info = new Infos();
    }

    $info->setPhone($_REQUEST['phone']);
    $info->setFacebook($_REQUEST['facebook']);
    $info->setMail($_REQUEST['mail']);
    $info->setFindUs($_REQUEST['find_us']);
    $info->setLat($_REQUEST['lat']);
    $info->setLng($_REQUEST['lng']);

    $id = $this->getInfosResource()->persist($info);
    
    $this->flash->addMessage('save-info', 'La info a bien été enregistrée.');
    $this->logger->info('Admin info save action [end]');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_infos_edit', array('id' => $id))
    );
  }
}
