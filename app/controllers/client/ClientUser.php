<?php

// TRANG CÁ NHÂN

class ClientUser extends Controller
{
  public function index()
  {
    $this->view("layout", [
      "title" => "Trang Tổng Quan",
      "page" => "user/index",
      "task" => 2
    ]);
  }

  public function profile()
  {
    $this->view("layout", [
      "title" => "Trang Cá Nhân",
      "page" => "user/profile",
      "task" => 2
    ]);
  }

  public function history()
  {
    $this->view("layout", [
      "title" => "Trang Lịch Sử",
      "page" => "user/history",
      "task" => 2
    ]);
  }

  public function password()
  {
    $this->view("layout", [
      "title" => "Trang Đổi Mật Khẩu",
      "page" => "user/password",
      "task" => 2
    ]);
  }
}
