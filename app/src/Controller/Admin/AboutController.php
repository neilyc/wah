<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Resource\AboutResource;
use App\Entity\About;

class AboutController extends AdminController
{
  protected $aboutResource = null;

  public function getAboutResource() {
    if($this->aboutResource == null) {
      $this->aboutResource = new AboutResource();
    }

    return $this->aboutResource;
  }

  public function editAction($request, $response)
  {
    $this->logger->info('Admin info list action [start]');

    $this->context += array(
      'about'  => $this->getAboutResource()->get(1),
    );

    $this->view->render($response, 'admin/about/edit.html.twig', $this->context);
    $this->logger->info('Admin info list action [end]');
    return $response;
  }

  public function saveAction($request, $response)
  {
    $this->logger->info('Admin info save action [start]');

    if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
      $info = $this->getAboutResource()->get($_REQUEST['id']);
    } else {
      $info = new About();
    }

    $info->setPhone($_REQUEST['phone']);
    $info->setFacebook($_REQUEST['facebook']);
    $info->setMail($_REQUEST['mail']);
    $info->setLat($_REQUEST['lat']);
    $info->setLng($_REQUEST['lng']);

    $id = $this->getAboutResource()->persist($info);
    
    $this->flash->addMessage('save-info', 'La info a bien été enregistrée.');
    $this->logger->info('Admin info save action [end]');
    return $response->withStatus(302)->withHeader(
      'Location', 
      $this->router->pathFor('admin_about_edit', array('id' => $id))
    );
  }
}
