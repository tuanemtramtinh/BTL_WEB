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

  public function updateOrderStatus($orderId, $status)
  {
    $query = "UPDATE `Order` SET `Status` = ? WHERE ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("si", $status, $orderId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
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
  public function getOrderByUserId($userId)
  {
    $queries = " SELECT
      o.ID,
      o.CreatedAt AS `date`,
      o.Total AS total,
      p.Name AS `name`,
      oi.Quantity AS quantity
    FROM
      `Order` o
    JOIN
      OrderItem oi ON o.ID = oi.Order_ID
    JOIN
      Product p ON oi.Product_ID = p.ID
    WHERE
      o.ID_Customer = ?
    ORDER BY
      o.CreatedAt DESC;
    ";
    $stmt = $this->conn->prepare($queries);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $orders = [];
    while ($row = $result->fetch_assoc()) {
      $orderId = $row['ID'];
      if (!isset($orders[$orderId])) {
        $orders[$orderId] = [
          "date" => $row['date'],
          "total" => $row['total'],
          "items" => [],
        ];
      }
      $orders[$orderId]["items"][] = [
        "product" => $row["name"],
        "quantity" => $row["quantity"]
      ];
    }
    return $orders;
  }
}
