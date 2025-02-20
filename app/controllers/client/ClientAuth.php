<?php

// TRANG ĐĂNG NHẬP/ĐĂNG KÝ

class ClientAuth extends Controller {
  public function index(){
    $this->login();
  }

  public function login(){
    $this->view("layout", [
      "title" => "Đăng Nhập",
      "page" => "auth/login"
    ]);
  }

  public function register(){
    $this->view("layout", [
      "title" => "Đăng Ký",
      "page" => "auth/register"
    ]);
  }
}