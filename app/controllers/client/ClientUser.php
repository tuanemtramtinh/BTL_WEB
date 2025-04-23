<?php

// TRANG CÁ NHÂN

class ClientUser extends Controller
{
  public function index()
  {
    $CustomerModel = $this->model("UserModel");
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Tổng Quan",
      "page" => "user/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo,
    ]);
  }

  public function profile()
  {
    $CustomerModel = $this->model("UserModel");
    $CustomerInfo = $CustomerModel->findUserById($_SESSION['userId']);
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Cá Nhân",
      "page" => "user/profile",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "customer" => $CustomerInfo,
    ]);
  }

  public function history()
  {
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Lịch Sử",
      "page" => "user/history",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2
    ]);
  }

  public function password()
  {
    $message = $this->getSessionMessage();
    $this->view("layout", [
      "title" => "Trang Đổi Mật Khẩu",
      "page" => "user/password",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2
    ]);
  }
}
