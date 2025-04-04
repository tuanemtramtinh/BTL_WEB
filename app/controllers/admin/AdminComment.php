<?php

class AdminComment extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Comment",
      "page" => "comment/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
