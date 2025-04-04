<?php

class OrderItemModel extends DB
{
  public function getOrderListByOrderId($orderId)
  {
    $query = "SELECT ID, ProductName, ProductPrice, ProductImage, Quantity, (Quantity * ProductPrice) as Total FROM OrderItem WHERE Order_ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();

    $result = $stmt->get_result();
    $items = [];
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }
    $stmt->close();
    return !empty($items) ? $items : null;
  }

  public function addItemToOrder($orderId, $productId, $quantity, $productName, $productPrice, $productImage)
  {
    $query = "INSERT INTO OrderItem (Order_ID, Product_ID, Quantity, ProductName, ProductPrice, ProductImage) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("iiisis", $orderId, $productId, $quantity, $productName, $productPrice, $productImage);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }
}
