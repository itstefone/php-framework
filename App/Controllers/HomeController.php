<?php

namespace itstefoneControllers;


class HomeController extends Controller {



  public function index() {
    


    return $this->render('home.index', [
      'firstname' => 'Stefke'
    ]);
  }
}