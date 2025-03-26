<?php

class AdminUser extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "User",
      "page" => "user/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
