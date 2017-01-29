<?php
namespace App\Entity;

use App\Entity;
use App\Helper\Upload;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="services", uniqueConstraints={@ORM\UniqueConstraint(name="service_id", columns={"id"})}))
 */
class Service
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="text")
   */
  protected $restauration;

  /**
   * @ORM\Column(type="text")
   */
  protected $autre;

  /**
   * Get service id
   *
   * @ORM\return integer
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Get service restauration
   *
   * @ORM\return string
   */
  public function getRestauration()
  {
      return $this->restauration;
  }

  /**
   * Get service autre
   *
   * @ORM\return string
   */
  public function getAutre()
  {
      return $this->autre;
  }

  /**
   * set service restauration
   *
   * @ORM\param $restauration
   */
  public function setRestauration($restauration)
  {
    $this->restauration = $restauration;
  }

  /**
   * set service autre
   *
   * @ORM\param $autre
   */
  public function setAutre($autre)
  {
    $this->autre = $autre;
  }
}