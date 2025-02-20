<?php

// TRANG HỎI/ĐÁP

class ClientQuestion extends Controller {
  public function index(){
    $this->view("layout", [
      "title" => "Hỏi/Đáp",
      "page" => "question/index",
      "task" => 2
    ]);
  }
}