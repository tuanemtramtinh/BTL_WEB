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

  public function profile(){
    $this->view("layout", [
      "title" => "Trang Cá Nhân",
      "page" => "user/profile",
      "task" => 2
    ]);
  }
}