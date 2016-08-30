<?php

namespace App\Resource;

use App\AbstractResource;

/**
 * Class Resource
 * @package App
 */
class UserResource extends AbstractResource
{
  /**
   * @param string|null $slug
   *
   * @return array
   */
  public function check($username, $password)
  {
    $return = array('result' => false);

    $user = $this->entityManager->getRepository('App\Entity\User')->findOneBy(
      array('username' => $username)
    );

    if($user && password_verify($password, $user->getPassword())) {
      $return['result'] = true;
      $return['user'] = $user;
    }

    return $return;
  }
}
