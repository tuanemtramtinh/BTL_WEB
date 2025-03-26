<?php
class AdminBlog extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Blog",
      "page" => "blog/index",
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
