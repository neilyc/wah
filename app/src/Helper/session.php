<?php
namespace App\Helper;

/**
 * Session
 */
class Session
{
  /**
   * Add Session value
   *
   * @param string $key The key to store the session value under
   * @param string $value Value to show on next request
   */
  public function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  /**
   * Get Session
   *
   * @return array Sesion to show for current request
   */
  public function getAll()
  {
    return $_SESSION;
  }
  
  /**
   * Get Session value
   * 
   * @param string $key The key to get the session value from
   * @return mixed|null Returns the session value
   */
  public function get($key)
  {
    //If the key exists then return value or null
    return (isset($_SESSION[$key])) ? $_SESSION[$key] : null;
  }

  /**
   * Get Session value
   * 
   * @param string $key The key to unset the session value from
   */
  public function remove($key) {
    unset($_SESSION[$key]);
  }
}
