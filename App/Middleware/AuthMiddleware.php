<?php

namespace App\Middleware;

use App\Core\Application;
use App\Exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware {

  protected $routes;

  public function __construct($routes = [])
  {
    $this->routes = $routes;
  }

  public  function execute() {

    if(!Application::$app->isLoggin()) {
      $action = Application::$app->controller->getAction();
      if(empty($this->routes)  || in_array($action, $this->routes)) {
        throw new ForbiddenException('Forbidden');
      }


    } 
 
  }
}