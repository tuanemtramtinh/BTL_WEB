<?php

class OrderModel extends DB
{
  public function getOrderList()
  {
    $query = "SELECT O.ID, O.Total, O.CreatedAt, O.UpdatedAt, O.`Status`, CONCAT(C.LastName, ' ',C.FirstName) as FullName, C.Email FROM `Order` AS O INNER JOIN Customer AS C ON O.ID_Customer = C.ID ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = [];
    while ($row = $result->fetch_assoc()) {
      $orders[] = $row;
    }

    $stmt->close();
    return !empty($orders) ? $orders : null;
  }

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
    $query = "SELECT O.ID, O.ID_Customer, O.Total, O.CreatedAt, O.UpdatedAt, O.`Status`, CONCAT(C.LastName, ' ',C.FirstName) as FullName, C.Email FROM `Order` AS O INNER JOIN Customer AS C ON O.ID_Customer = C.ID WHERE O.ID = ?";
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
