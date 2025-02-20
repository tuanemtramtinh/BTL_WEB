<?php

// TRANG GIỚI THIỆU

class ClientAbout extends Controller {
  public function index(){
    $this->view("layout", [
      "title" => "Giới Thiệu",
      "page" => "about/index",
      "task" => 2
    ]);
  }
}