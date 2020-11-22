<?php


namespace App\Core;


class Session {



  public function __construct() {
    session_start();

    $flashMessages = $_SESSION['flash_messages'] ?? [];

    foreach($flashMessages as $key => &$message) {
            $message['removed'] = true;
    } 

    $_SESSION['flash_messages'] = $flashMessages;

  }


  public function getMessage($key) {
          return $_SESSION['flash_messages'][$key]['message'] ?? false;
  }



  public function setFlashMessage($key, $message){
      $_SESSION['flash_messages'][$key] = [
          'removed' => false,
          'message' => $message
      ];
  }

  public function set($key,$value) {
      $_SESSION[$key] = $value;
  }

  public function get($key) {

    return $_SESSION[$key] ?? false;
  }
  public function remove($key) {

    unset($_SESSION[$key]);

  }



  public function __destruct()
  {
    $flashMessages =  $_SESSION['flash_messages'] ?? [];

    foreach($flashMessages as $key => &$message) {
      if($message['removed']) {
        unset($flashMessages[$key]);
      }
        
    }
    $_SESSION['flash_messages'] = $flashMessages;
  }
}