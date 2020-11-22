<?php

namespace itstefoneCore;



class Request {


  protected $data;


  public function __construct()
  {
    $this->data = [];
  }


  public function getPath() {

    $path = $_SERVER['REQUEST_URI'];

    $position = strpos($path, '?');

    if(!$position) {
      return $path;
    }

      return substr($path, 0, $position);
  }


  public function getMethod() {


    return strtolower($_SERVER['REQUEST_METHOD']);
  }




  public function getBody() {

    foreach($_GET as $key =>$value) {

      $this->data[$key] = $value;
    }


    foreach($_POST as $key =>$value) {
      $this->data[$key] = $value;
    }

  }



  public function all() {
    return $this->data;
  }

  public function __get($property) {

    if(array_key_exists($property, $this->data)) {
      return $this->data[$property];
    }

  }



}