<?php


namespace itstefone\Controllers;

use itstefone\Core\Application;
use itstefone\Core\Request;
use itstefone\Models\LoginForm;

class LoginController extends Controller {



  public function index() {
    $this->setLayout('nonav');
    $loginForm = new LoginForm([]);
    return $this->render('login.index', [
      'model' => $loginForm
    ]);
  }
  public function store(Request $request) {

    $loginForm = new LoginForm($request->all());
    if(!$loginForm->validate() || !$loginForm->login()) {
      return $this->render('login.index', [
        'model' => $loginForm
      ]);
    } else {
      Application::$app->response->redirect('/');
    }
  }



  public function logout(){
    Application::$app->logout();
    Application::$app->response->redirect('/');
  }
}