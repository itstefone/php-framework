<?php


namespace itstefoneCore;



class Response {



  public function setStatusCode($status) {
    http_response_code($status);
  }


  public function redirect($path) {
    header('Location: ' . $path);
  }
}