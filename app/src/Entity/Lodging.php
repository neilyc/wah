<?php
namespace App\Entity;

use App\Entity;
use App\Helper\Upload;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lodging", uniqueConstraints={@ORM\UniqueConstraint(name="photo_id", columns={"id"})}))
 */
class Lodging
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
   * Get photo id
   *
   * @ORM\return integer
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Get photo title
   *
   * @ORM\return string
   */
  public function getTitle()
  {
      return $this->title;
  }

  /**
   * Get photo image
   *
   * @ORM\return string
   */
  public function getImage()
  {
      return $this->image;
  }

  /**
   * set photo title
   *
   * @ORM\param $title
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * set photo image
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
      $handle->process('upload/photo/');
      if ($handle->processed) {
        $this->setImage($handle->file_dst_name);
        $handle->clean();
      } else {

      }
    }
  }
}