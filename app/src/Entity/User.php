<?php
namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
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
  protected $username;

  /**
   * @ORM\Column(type="string", length=64)
   */
  protected $email;

  /**
   * @ORM\Column(type="string", length=200)
   */
  protected $password;



  /**
   * {@inheritDoc}
   */
  public function getId()
  {
    return $this->id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Gets the encrypted password.
   *
   * @return string
   */
  public function getPassword()
  {
    return $this->password;
  }

  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  public function __toString()
  {
    return (string) $this->getUsername();
  }
}
