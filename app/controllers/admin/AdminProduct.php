<?php

class AdminProduct extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function detail()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function createProduct()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Product",
      "page" => "product/create",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }

  public function add()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Create Product",
      "page" => "product/add",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3
    ]);
  }
}
