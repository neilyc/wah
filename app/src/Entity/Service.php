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
   * @ORM\Column(type="string", length=64)
   */
  protected $title;

  /**
   * @ORM\Column(type="string", length=150)
   */
  protected $image;

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
   * Get service title
   *
   * @ORM\return string
   */
  public function getTitle()
  {
      return $this->title;
  }

  /**
   * Get service image
   *
   * @ORM\return string
   */
  public function getImage()
  {
      return $this->image;
  }

  /**
   * set service title
   *
   * @ORM\param $title
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * set service image
   *
   * @ORM\param $image
   */
  public function setImage($image)
  {
    $this->image = $image;
  }


  public function uploadImage($img) {
    $handle = new Upload($img);
    if ($handle->uploaded) {
      $handle->process('upload/service/');
      if ($handle->processed) {
        $this->setImage($handle->file_dst_name);
        $handle->clean();
      } else {

      }
    }
  }
}