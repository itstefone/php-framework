<?php


namespace itstefone\Core;



class Response {



  public function setStatusCode($status) {
    http_response_code($status);
  }


  public function redirect($path) {
    header('Location: ' . $path);
  }
}