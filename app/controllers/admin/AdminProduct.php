<?php

class AdminProduct extends Controller{
  public function index() {
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/index"
    ]);
  }

  public function detail(){
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/detail"
    ]);
  }

  public function createProduct() {
    
  }
}