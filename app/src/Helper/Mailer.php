<?php
namespace App\Helper;

// C'est moche, mais c'est mieux que rien !

/**
 * Mailer
 */
class Mailer
{
  function  __construct()  {
    require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
    $settings = require '../app/settings.php';
    $settings = $settings['settings']['mailer'];

    $mail = new \PHPMailer;

    $mail->isSMTP();                                      
    $mail->Host =  $settings['host'];
    $mail->SMTPAuth =  $settings['SMTPAuth'];
    $mail->Username =  $settings['user'];
    $mail->Password =  $settings['password'];
    $mail->SMTPSecure =  $settings['SMTPSecure'];
    $mail->Port =  $settings['port'];

    return $mail;
  }
}
