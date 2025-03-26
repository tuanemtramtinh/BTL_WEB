<?php

// TRANG CHỦ

class ClientHome extends Controller
{
  public function index()
  {
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Chủ",
      "page" => "home/index",
      "task" => 1,
      "error" => $message['error'],
      "success" => $message['success']
    ]);
  }
}
