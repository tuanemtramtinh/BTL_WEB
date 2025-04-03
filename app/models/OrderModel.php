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
}
