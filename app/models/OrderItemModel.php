<?php

class OrderItemModel extends DB
{
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
