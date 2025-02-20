<?php

// TRANG GIỎ HÀNG

class ClientCart extends Controller {
  public function index(){
    $this->view("layout", [
      "title" => "Giỏ Hàng",
      "page" => "cart/index",
      "task" => 3
    ]);
  }
}