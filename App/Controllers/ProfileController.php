<?php

namespace App\Controllers;

use App\Middleware\AuthMiddleware;

class ProfileController extends Controller {



  public function __construct()
  {
    $this->setMiddleware(new AuthMiddleware(['index']));
  }

  public function index() {

    return $this->render('profile.index');

  }
}