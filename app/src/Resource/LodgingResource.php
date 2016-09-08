<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class LodgingResource extends AbstractResource
{
  /**
   * @param string|null $id
   *
   * @return array
   */
  public function get($id = null)
  {
    if ($id === null) {
      return $this->entityManager->getRepository('App\Entity\Lodging')->findAll();
    }

    if($lodging = $this->entityManager->getRepository('App\Entity\Lodging')->find($id)) {
      return $lodging;
    }

    return false;
  }
}