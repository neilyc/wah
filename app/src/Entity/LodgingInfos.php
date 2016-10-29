<?php
namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lodging_infos", uniqueConstraints={@ORM\UniqueConstraint(name="lodging_info_id", columns={"id"})}))
 */
class LodgingInfos
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
  protected $description;

  /**
   * @ORM\Column(type="text")
   */
  protected $equipement;

  /**
   * @ORM\Column(type="text")
   */
  protected $espace;

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
   * Get info description
   *
   * @ORM\return string
   */
  public function getDescription()
  {
      return $this->description;
  }

  /**
   * Get info equipement
   *
   * @ORM\return string
   */
  public function getEquipement()
  {
      return $this->equipement;
  }

  /**
   * Get info espace
   *
   * @ORM\return string
   */
  public function getEspace()
  {
      return $this->espace;
  }


  /**
   * set info description
   *
   * @ORM\param $description
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }

  /**
   * set info equipement
   *
   * @ORM\param $equipement
   */
  public function setEquipement($equipement)
  {
    $this->equipement = $equipement;
  }

  /**
   * set info espace
   *
   * @ORM\param $espace
   */
  public function setEspace($espace)
  {
    $this->espace = $espace;
  }
}