<?php

// TRANG GIỚI THIỆU

class ClientAbout extends Controller
{
  public function index()
  {
    $MemModel = $this->model("MemModel");
    $member = $MemModel->getAllMem();
    $this->view("layout", [
      "title" => "Giới Thiệu",
      "page" => "about/index",
      "task" => 2,
      "member" => $member
    ]);
  }
}
