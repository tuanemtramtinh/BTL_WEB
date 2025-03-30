<?php
class AdminContact extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Contact",
      "page" => "contact/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 1
    ]);
  }
}
