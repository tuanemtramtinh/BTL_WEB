<?php

class App
{
  protected $controller = "ClientHome";
  protected $method = "index";
  protected $params = [];
  protected $isAdmin = false;

  public function __construct()
  {
    $url = $this->parseUrl();

    if (isset($url[0]) && $url[0] == 'admin') {
      $this->isAdmin = true;
      unset($url[0]);
      $url[1] = isset($url[1]) ? ucfirst($url[1]) : 'Dashboard';
      $url[1] = 'Admin' . $url[1];
      if (isset($url[1]) && file_exists('./app/controllers/admin/' . $url[1] . '.php')) {
        $this->controller = $url[1];
        unset($url[1]);
      }
      require_once './app/controllers/admin/' . $this->controller . '.php';
      $this->controller = new $this->controller;
      if (isset($url[2]) && method_exists($this->controller, $url[2])) {
        $this->method = $url[2];
        unset($url[2]);
      }
    } else {
      if (isset($url[0])) {
        $url[0] = ucfirst($url[0]);
        $url[0] = 'Client' . $url[0];
        if (file_exists('./app/controllers/client/' . $url[0] . '.php')) {
          $this->controller = $url[0];
          unset($url[0]);
        }
      }
      require_once './app/controllers/client/' . $this->controller . '.php';
      $this->controller = new $this->controller;
      if (isset($url[1]) && method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    // Get the parameters
    $this->params = $url ? array_values($url) : [];

    // Update General
    call_user_func_array([$this->controller, 'getGeneral'], []);

    //HandleRemeberMe
    if (
      !$this->isAdmin &&
      method_exists($this->controller, 'rememberClient') // Check method existence on the instance
      // !($this->controller instanceof ClientAuth && in_array($this->method, ['login', 'register']))
    ) {
      // Call the rememberClient method using call_user_func_array
      call_user_func_array([$this->controller, 'rememberClient'], []);
    } else if (
      $this->isAdmin &&
      method_exists($this->controller, 'rememberAdmin') //&&
      // !($this->controller instanceof AdminAuth && in_array($this->method, ['login', 'register']))
    ) {
      call_user_func_array([$this->controller, 'rememberAdmin'], []);
    }

    // Call the method with parameters
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseUrl()
  {
    if (isset($_GET['url'])) {
      return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
  }
}
