<?php

// TRANG LIÊN HỆ

class ClientContact extends Controller {
  public function index(){
    $this->view("layout", [
      "title" => "Liên Hệ",
      "page" => "contact/index",
      "task" => 1
    ]);
  }
}