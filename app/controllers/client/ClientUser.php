<?php

// TRANG CÁ NHÂN

class ClientUser extends Controller {
  public function index(){
    $this->view("layout", [
      "title" => "Trang Cá Nhân",
      "page" => "user/index",
      "task" => 2
    ]);
  }
}