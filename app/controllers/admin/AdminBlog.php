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
      "task" => 4,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function content() {

    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Blog's Content",
      "page" => "blog/content",
      "task" => 4,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function detail()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Chi Tiết Blog",
      "page" => "blog/detail",
      "task" => 4,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }

  public function add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Tạo Blog",
      "page" => "blog/add",
      "task" => 4,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
