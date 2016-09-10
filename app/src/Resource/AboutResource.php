<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class AboutResource extends AbstractResource
{
  /**
   * @param string|null $id
   *
   * @return array
   */
  public function get($id = null)
  {
    if ($id === null) {
      return $this->entityManager->getRepository('App\Entity\About')->findAll();
    }

    if($about = $this->entityManager->getRepository('App\Entity\About')->find($id)) {
      return $about;
    }

    return false;
  }
}