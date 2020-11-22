<?php



namespace itstefone\Core;

use itstefone\Exception\ForbiddenException;
use Exception;

class Router
{


  protected $routes;
  protected $request;
  public function __construct(Request $request)
  {
    $this->request = $request;
    $this->routes = [];
  }

  public function addRoute($method, $path, $action)
  {
    $path = str_replace('/', '', $path);
    $this->routes[$method][$path] = $action;
  }



  public function resolve()
  {
    $path =  str_replace('/', '',  $this->request->getPath());
    $method = $this->request->getMethod();

    $action = $this->routes[$method][$path] ?? false;

    if (!$action) {
      Application::$app->response->setStatusCode(404);
      return 'Not Found';
    }


    if (is_array($action)) {
      $action[0] = new $action[0];
      Application::$app->setController($action[0]);
      Application::$app->controller->setAction($action[1]);
      $middlewares =  Application::$app->controller->getMiddlewares();

      foreach ($middlewares as $middleware) {
        $middleware->execute();
      }
    }
    $this->request->getBody();
    return call_user_func($action, $this->request);
  }



  public function render($view, $params = [])
  {


    $view = $this->renderView($view, $params);
    $layout = $this->renderLayout();
    return str_replace('{{content}}', $view, $layout);
  }


  protected function renderView($view, $params = [])
  {


    foreach ($params as $key => $value) {
      $$key = $value;
    }

    $view = str_replace('.', '/', $view);
    ob_start();
    $view = Application::$app->rootPath . '/App/View/' . $view . '.php';
    require_once $view;

    return ob_get_clean();
  }

  protected function renderLayout()
  {

    ob_start();
    $layoutView = Application::$app->controller->getLayout();
    $layout = Application::$app->rootPath . '/App/View/layouts/' . $layoutView . '.php';
    require_once $layout;

    return ob_get_clean();
  }


  public function renderOnlyView($view, $params = [])
  {


    $view = $this->renderView($view, $params);
    $layout = $this->renderLayout();

    return str_replace('{{content}}', $view, $layout);
  }
}
