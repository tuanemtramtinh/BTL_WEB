<?php
class AdminHome extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Home",
      "page" => "home/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
