<?php
class AdminAbout extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "About",
      "page" => "about/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
