<?php


namespace App\Controllers;

use App\Core\Application;
use App\Core\Request;
use App\Models\LoginForm;

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