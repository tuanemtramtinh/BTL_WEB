<?php

class AdminOrder extends Controller
{
  public function index()
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    $Order = $this->model("OrderModel");

    $orders = $Order->getOrderList();

    $Order->closeConnection();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Order",
      "page" => "order/index",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "orders" => $orders
    ]);
  }

  public function changeStatus($orderId = '', $status = '')
  {
    header("Content-Type: application/json");
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    if ($orderId === '' || $status === '') {
      echo json_encode([
        "status" => false,
        "message" => "Invalid Order"
      ]);
      $_SESSION['error_message'] = "Invalid Order";
      exit;
    }

    $Order = $this->model("OrderModel");

    if ($Order->updateOrderStatus($orderId, $status)) {
      $Order->closeConnection();
      echo json_encode([
        "status" => true,
        "message" => "Order status updated successfully"
      ]);
      $_SESSION['success_message'] = "Order status updated successfully";
    } else {
      $Order->closeConnection();
      echo json_encode([
        "status" => false,
        "message" => "Failed to update order status"
      ]);
      $_SESSION['error_message'] = "Failed to update order status";
    }
  }

  public function detail($orderId = '')
  {
    //Check if the employee is logged in
    $this->checkAuthAdmin();

    if ($orderId === '') {
      $_SESSION['error_message'] = "Invalid Order";
      header("Location: ../index");
      exit;
    }

    $Order = $this->model("OrderModel");
    $OrderItem = $this->model("OrderItemModel");

    $order = $Order->findOrderById($orderId);
    $items = $OrderItem->getOrderListByOrderId($orderId);

    $Order->closeConnection();
    $OrderItem->closeConnection();

    $message = $this->getSessionMessage();
    $this->viewAdmin("layout", [
      "title" => "Order Detail",
      "page" => "order/detail",
      "error" => $message['error'],
      "success" => $message['success'],
      "task" => 3,
      "order" => $order,
      "items" => $items
    ]);
  }
}
