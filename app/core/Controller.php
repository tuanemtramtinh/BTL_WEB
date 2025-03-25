<?php

class Controller
{
  public function model($model)
  {
    require_once './app/models/' . $model . '.php';
    return new $model();
  }
  public function view($view, $data = [])
  {
    require_once './app/views/client/' . $view . '.php';
  }
  public function viewAdmin($view, $data = [])
  {
    require_once './app/views/admin/' . $view . '.php';
  }
  public function getSessionMessage()
  {
    $errorKey = 'error_message';
    $successKey = 'success_message';
    $error = isset($_SESSION[$errorKey]) ? $_SESSION[$errorKey] : null;
    $success = isset($_SESSION[$successKey]) ? $_SESSION[$successKey] : null;

    unset($_SESSION[$errorKey], $_SESSION[$successKey]);

    return [
      'error' => $error,
      'success' => $success
    ];
  }
}
