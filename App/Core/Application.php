<?php


namespace itstefoneCore;

use itstefoneControllers\Controller;
use itstefoneException\ForbiddenException;
use itstefoneModels\DbModel;
use Exception;

class Application {

  public static $app;

  private Router $router;
  private Request $request;
  private $rootPath;
  private Response $response;
  private Database $db;
  private Session $session;
  private Controller $controller;
  private ?DbModel $user;
  private $userClass;
  public function __construct($path, array $config)
  {
    $this->userClass = $config['userClass'];
    $this->rootPath = $path;
    $this->response = new Response();
    $this->request = new Request();
    $this->session = new Session();
    $this->router = new Router($this->request);
    $this->config = $config;
    $this->db = new Database($this->config['db']);
    self::$app = $this;
    $primaryKey = $this->userClass::primaryKey();
    $primaryValue = $this->session->get('user');
    $user = $this->userClass::findOne([$primaryKey => $primaryValue]) ?? null;
    if($user) {
      $this->user = $user;
    } else {
      $this->user  = null;
    }
  }



  public function setController(Controller $controller) {
    $this->controller = $controller;
  }

  public function get($path, $action) {
        $this->router->addRoute('get', $path, $action);
  }

  public function post($path, $action) {
    $this->router->addRoute('post', $path, $action);
  }


  public function isLoggin() {
    return    $this->user ? true : false;
  }


  public function run() {

      try {
        echo $this->router->resolve();
      }
         catch(ForbiddenException $e) {
            echo $this->router->renderOnlyView('exception', [
              'statusCode' => $e->statusCode,
              'message' => $e->getMessage()
            ]);
         }
         catch(Exception $e) {

         }
    
  }



  public function __get($property) {
    if(property_exists($this,$property)) {
      return $this->{$property};
    }
  }


  public function login(DbModel $user) {
      $this->user = $user;
      $primaryKey = $user::primaryKey();
      $value = $this->user->{$primaryKey};
      $this->session->set('user', $value);
  }


  public function logout() {
    $this->user = null;
    $this->session->remove('user');
  }

}