<?php
namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="infos", uniqueConstraints={@ORM\UniqueConstraint(name="info_id", columns={"id"})}))
 */
class Infos
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length=64)
   */
  protected $phone;

  /**
   * @ORM\Column(type="string", length=64)
   */
  protected $mail;

  /**
   * @ORM\Column(type="string", length=64)
   */
  protected $facebook;

  /**
   * @ORM\Column(type="string", length=64)
   */
  protected $lat;

  /**
   * @ORM\Column(type="string", length=64)
   */
  protected $lng;
  /**
   * Get info id
   *
   * @ORM\return integer
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Get info phone
   *
   * @ORM\return string
   */
  public function getPhone()
  {
      return $this->phone;
  }

  /**
   * Get info facebook
   *
   * @ORM\return string
   */
  public function getFacebook()
  {
      return $this->facebook;
  }

  /**
   * Get info lat
   *
   * @ORM\return string
   */
  public function getLat()
  {
      return $this->lat;
  }

  /**
   * Get info lng
   *
   * @ORM\return string
   */
  public function getLng()
  {
      return $this->lng;
  }

  /**
   * Get info mail
   *
   * @ORM\return string
   */
  public function getMail()
  {
      return $this->mail;
  }

  /**
   * set info phone
   *
   * @ORM\param $phone
   */
  public function setPhone($phone)
  {
    $this->phone = $phone;
  }

  /**
   * set info mail
   *
   * @ORM\param $mail
   */
  public function setMail($mail)
  {
    $this->mail = $mail;
  }

  /**
   * set info facebook
   *
   * @ORM\param $facebook
   */
  public function setFacebook($facebook)
  {
    $this->facebook = $facebook;
  }

  /**
   * set info lat
   *
   * @ORM\param $lat
   */
  public function setLat($lat)
  {
    $this->lat = $lat;
  }

  /**
   * set info lng
   *
   * @ORM\param $lng
   */
  public function setLng($lng)
  {
    $this->lng = $lng;
  }
}