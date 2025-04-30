<?php

class AdminUser extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();
    $CustomerModel = $this->model("UserModel");
    $Customers = $CustomerModel->getAllUser();
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "User",
      "page" => "user/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "users" => $Customers
    ]);
  }
  public function viewUserInfo()
  {
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $CustomerModel = $this->model('UserModel');
    $Customer = $CustomerModel->findUserById($id);
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "User Info",
      "page" => "user/info-detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "user" => $Customer
    ]);
  }
  public function viewUserPurchase()
  {
    $this->checkAuthAdmin();
    $id = $_GET['id'];
    $OrderModel = $this->model('OrderModel');
    $Orders = $OrderModel->getOrderByUserId($id);
    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "User's Order Info",
      "page" => "user/order-detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 2,
      "orders" => $Orders
    ]);
  }
}
