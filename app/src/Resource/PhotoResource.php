<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class PhotoResource extends AbstractResource
{
  /**
   * @param string|null $id
   *
   * @return array
   */
  public function get($id = null)
  {
    if ($id === null) {
      return $this->entityManager->getRepository('App\Entity\Photo')->findAll();
    }

    if($photo = $this->entityManager->getRepository('App\Entity\Photo')->find($id)) {
      return $photo;
    }

    return false;
  }
}