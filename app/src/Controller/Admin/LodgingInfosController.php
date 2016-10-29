<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Resource\LodgingInfosResource;
use App\Entity\LodgingInfos;

class LodgingInfosController extends AdminController
{
  protected $lodgingInfosResource = null;

  public function getLodgingInfosResource() {
    if($this->lodgingInfosResource == null) {
      $this->lodgingInfosResource = new LodgingInfosResource();
    }

    return $this->lodgingInfosResource;
  }

  public function saveAction($request, $response)
  {
    $this->logger->info('Admin info save action [start]');

    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $info = $this->getLodgingInfosResource()->get($_REQUEST['id']);
    } else {
      $info = new LodgingInfos();
    }

    $info->setDescription($_REQUEST['description']);
    $info->setEquipement($_REQUEST['equipement']);
    $info->setEspace($_REQUEST['espace']);

    $id = $this->getLodgingInfosResource()->persist($info);
    
    $this->flash->addMessage('save-info', 'La info a bien été enregistrée.');
    $this->logger->info('Admin info save action [end]');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_lodging_list')
    );
  }
}
