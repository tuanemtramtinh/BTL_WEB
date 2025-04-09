<?php

class CartModel extends DB
{
  public function getCartList()
  {
    $query = "SELECT C.ID, C.Total, C.CreatedAt, C.UpdatedAt, CONCAT(CU.LastName,' ',CU.FirstName) AS FullName, CU.Email FROM Cart AS C INNER JOIN Customer AS CU ON C.ID_Customer = CU.ID";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $carts = [];
    while ($row = $result->fetch_assoc()) {
      $carts[] = $row;
    }

    $stmt->close();
    return !empty($carts) ? $carts : null;
  }

  public function createCart($userId)
  {
    $query = "INSERT INTO Cart (ID_Customer) VALUES (?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function resetCart($userId)
  {
    $query = "UPDATE Cart SET Total = 0 WHERE ID_Customer = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }

  public function findCartByUserId($userId)
  {
    $query = "SELECT O.ID, O.ID_Customer, O.Total, O.CreatedAt, O.UpdatedAt, CONCAT(C.LastName, ' ',C.FirstName) as FullName, C.Email FROM Cart AS O INNER JOIN Customer AS C ON O.ID_Customer = C.ID WHERE O.ID_Customer = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  public function findCartById($cartId)
  {
    $query = "SELECT O.ID, O.ID_Customer, O.Total, O.CreatedAt, O.UpdatedAt, CONCAT(C.LastName, ' ',C.FirstName) as FullName, C.Email FROM Cart AS O INNER JOIN Customer AS C ON O.ID_Customer = C.ID WHERE O.ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $cartId);
    $stmt->execute();

    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    }
    return null;
  }

  public function updateCartTotal($cartId, $total)
  {
    $query = "UPDATE Cart SET Total = ? WHERE ID = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii", $total, $cartId);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
  }
}
