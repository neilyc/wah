<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class ServiceResource extends AbstractResource
{
  /**
   * @param string|null $id
   *
   * @return array
   */
  public function get($id = null)
  {
    if ($id === null) {
      return $this->entityManager->getRepository('App\Entity\Service')->findAll();
    }

    if($service = $this->entityManager->getRepository('App\Entity\Service')->find($id)) {
      return $service;
    }

    return false;
  }
}