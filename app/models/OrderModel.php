<?php

class OrderModel extends DB
{
  public function createOrder($userId, $total)
  {
    $query = "INSERT INTO `Order` (ID_Customer, Total) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $userId, $total);
    $result = $stmt->execute();
    $insertId = $stmt->insert_id;
    $stmt->close();

    return $insertId;
  }

  public function findOrderById($orderId)
  {
    $query = "SELECT * FROM `Order` WHERE ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }
}
