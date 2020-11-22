<?php

namespace itstefoneControllers;

use itstefoneMiddleware\AuthMiddleware;

class ProfileController extends Controller {



  public function __construct()
  {
    $this->setMiddleware(new AuthMiddleware(['index']));
  }

  public function index() {

    return $this->render('profile.index');

  }
}