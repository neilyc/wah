<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class InfosResource extends AbstractResource
{
  /**
   * @param string|null $id
   *
   * @return array
   */
  public function get($id = null)
  {
    if ($id === null) {
      return $this->entityManager->getRepository('App\Entity\Infos')->findAll();
    }

    if($photo = $this->entityManager->getRepository('App\Entity\Infos')->find($id)) {
      return $photo;
    }

    return false;
  }
}