<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class LodgingInfosResource extends AbstractResource
{
  /**
   * @param string|null $id
   *
   * @return array
   */
  public function get($id = null)
  {
    if ($id === null) {
      return $this->entityManager->getRepository('App\Entity\LodgingInfos')->findAll();
    }

    if($lodgingInfos = $this->entityManager->getRepository('App\Entity\LodgingInfos')->find($id)) {
      return $lodgingInfos;
    }

    return false;
  }
}