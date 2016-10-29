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
   * @ORM\Column(type="string", length=150)
   */
  protected $name;

  /**
   * @ORM\Column(type="text")
   */
  protected $description;

  /**
   * @ORM\Column(type="string", length=150)
   */
  protected $price;

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
   * Get photo name
   *
   * @ORM\return string
   */
  public function getName()
  {
      return $this->name;
  }

  /**
   * Get photo description
   *
   * @ORM\return string
   */
  public function getDescription()
  {
      return $this->description;
  }

  /**
   * Get photo price
   *
   * @ORM\return string
   */
  public function getPrice()
  {
      return $this->price;
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
   * set photo name
   *
   * @ORM\param $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * set photo description
   *
   * @ORM\param $description
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }

  /**
   * set photo price
   *
   * @ORM\param $price
   */
  public function setPrice($price)
  {
    $this->price = $price;
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
      $handle->process('upload/lodging/');
      if ($handle->processed) {
        $this->setImage($handle->file_dst_name);
        $handle->clean();
      } else {

      }
    }
  }
}