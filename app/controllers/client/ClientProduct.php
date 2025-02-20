<?php

// TRANG SẢN PHẨM

class ClientProduct extends Controller {
  public function index(){
    $this->view("layout", [
      "title" => "Sản Phẩm",
      "page" => "product/index",
      "task" => 3
    ]);
  }

  public function detail() {
    $this->view("layout", [
      "title" => "Chi Tiết Sản Phẩm",
      "page" => "product/detail",
      "task" => 3
    ]);
  }
}