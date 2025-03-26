<?php
class AdminQuestion extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Question",
      "page" => "question/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
