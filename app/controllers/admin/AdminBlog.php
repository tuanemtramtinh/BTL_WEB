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

  public function detail()
  {
    $this->viewAdmin("layout", [
      "title" => "Chi Tiết Blog",
      "page" => "blog/detail"
    ]);
  }

  public function add() {
    $this->viewAdmin("layout", [
      "title" => "Tạo Blog",
      "page" => "blog/add"
    ]);
  }
}
