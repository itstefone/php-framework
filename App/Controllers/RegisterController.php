<?php


namespace itstefone\Controllers;

use itstefone\Core\Request;
use itstefone\Models\User;
use itstefone\Core\Application;

class RegisterController extends Controller {




  public function index() {



    return $this->render('register.index', [
      'model' => new User([])
    ]);
  }


  public function store(Request $request) {
      
    $user = new User($request->all());

   

    if(!$user->validate() ||  !$user->register()) {
      return $this->render('register.index', [
        'model' => $user
      ]);
    }

    
    Application::$app->session->setFlashMessage('success', 'Thanks for registration');

    return $this->redirect('/');
    
    
  }
}