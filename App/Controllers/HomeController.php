<?php

namespace itstefone\Controllers;


class HomeController extends Controller {



  public function index() {
    


    return $this->render('home.index', [
      'firstname' => 'Stefke'
    ]);
  }
}