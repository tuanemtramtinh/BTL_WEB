<?php

// TRANG CHỦ

class ClientHome extends Controller
{
  public function index()
  {
    $this->view("layout", [
      "title" => "Trang Chủ",
      "page" => "home/index",
      "task" => 1
    ]);
  }
}
