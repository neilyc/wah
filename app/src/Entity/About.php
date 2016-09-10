<?php
namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="about", uniqueConstraints={@ORM\UniqueConstraint(name="about_id", columns={"id"})}))
 */
class About
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
   * Get about id
   *
   * @ORM\return integer
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Get about phone
   *
   * @ORM\return string
   */
  public function getPhone()
  {
      return $this->phone;
  }

  /**
   * Get about facebook
   *
   * @ORM\return string
   */
  public function getFacebook()
  {
      return $this->facebook;
  }

  /**
   * Get about lat
   *
   * @ORM\return string
   */
  public function getLat()
  {
      return $this->lat;
  }

  /**
   * Get about lng
   *
   * @ORM\return string
   */
  public function getLng()
  {
      return $this->lng;
  }

  /**
   * Get about mail
   *
   * @ORM\return string
   */
  public function getMail()
  {
      return $this->mail;
  }

  /**
   * set about phone
   *
   * @ORM\param $phone
   */
  public function setPhone($phone)
  {
    $this->phone = $phone;
  }

  /**
   * set about mail
   *
   * @ORM\param $mail
   */
  public function setMail($mail)
  {
    $this->mail = $mail;
  }

  /**
   * set about facebook
   *
   * @ORM\param $facebook
   */
  public function setFacebook($facebook)
  {
    $this->facebook = $facebook;
  }

  /**
   * set about lat
   *
   * @ORM\param $lat
   */
  public function setLat($lat)
  {
    $this->lat = $lat;
  }

  /**
   * set about lng
   *
   * @ORM\param $lng
   */
  public function setLng($lng)
  {
    $this->lng = $lng;
  }
}