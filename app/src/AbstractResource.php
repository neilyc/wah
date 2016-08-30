<?php

namespace App;

use Doctrine\ORM\EntityManager;

abstract class AbstractResource
{
  /**
   * @var \Doctrine\ORM\EntityManager
   */
  protected $entityManager = null;

  public function __construct()
  {
    $settings = require '../app/settings.php';
    $settings = $settings['settings'];
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
      $settings['doctrine']['meta']['entity_path'],
      $settings['doctrine']['meta']['auto_generate_proxies'],
      $settings['doctrine']['meta']['proxy_dir'],
      $settings['doctrine']['meta']['cache'],
      false
    );
    $this->setEntityManager(\Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config));
  }

  private function setEntityManager($em) {
    if($this->entityManager == null) {
      $this->entityManager = $em;
    }

    return $this->entityManager;
  }

  public function remove($entity) 
  {
    $this->entityManager->remove($entity);
    $this->entityManager->flush();
  }

  public function persist($entity) 
  {
    $this->entityManager->persist($entity);
    $this->entityManager->flush();

    return $entity->getId();
  }
}
