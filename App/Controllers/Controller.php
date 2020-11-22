<?php

namespace itstefoneControllers;

use itstefoneCore\Application;
use itstefoneMiddleware\BaseMiddleware;

abstract class Controller {

  protected $layout = 'main';

  protected $action = '';


  public function setAction(string $action) {
    $this->action = $action;
  }

  public function getAction() {
    return $this->action;
  }


  protected $middlewares = [];


  public function __construct()
  {
    $this->layout = 'main';
  }



  public function setLayout($layout) {
    $this->layout = $layout;
  }

  public function getLayout() {
    return $this->layout;
  }

  public function render($path, $params = []) {


    return Application::$app->router->render($path, $params);

  }

  public function redirect($path) {
    return Application::$app->response->redirect($path);
  }



  public function setMiddleware(BaseMiddleware $middleware) {
      $this->middlewares[] = $middleware;
  }


  public function getMiddlewares() {
    return $this->middlewares;
  }

}