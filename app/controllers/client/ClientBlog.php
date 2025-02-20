<?php

// TRANG DANH SÁCH BÀI VIẾT

class ClientBlog extends Controller {
  public function index(){
    $this->view("layout", [
      "title" => "Danh Sách Bài Viết",
      "page" => "blog/index",
      "task" => 4
    ]);
  }

  public function detail() {
    $this->view("layout", [
      "title" => "Chi Tiết Bài Viết",
      "page" => "blog/detail",
      "task" => 4
    ]);
  }
}